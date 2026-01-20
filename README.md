# Kubernetes

Ta projekt predstavlja migracijo prejšnje Docker Compose arhitekture v produkcijsko pripravljen **Kubernetes (K8s)** stack. Osredotoča se na visoko razpoložljivost (HA), avtomatizirano upravljanje TLS certifikatov in posodobitve brez izpada (Zero-downtime updates).

---

## Arhitektura

Aplikacija je razdeljena na 5 storitev:

1.  **Ingress (Nginx)**: Vstopna točka, ki skrbi za usmerjanje prometa in TLS terminacijo.
2.  **Caddy**: Web strežnik, ki služi kot reverse-proxy za PHP-FPM.
3.  **PHP (8.3 FPM)**: Jedro aplikacije, ki teče v **3 replikah** (HA).
4.  **MySQL (8.0)**: Relacijska baza podatkov s persistentnim shranjevanjem.
5.  **Redis (7)**: Predpomnilnik (cache) za seje in hitre dostope.

---

## Infrastruktura

Celotna rešitev je zasnovana in testirana za uporabo v **MicroK8s** okolju. Za delovanje so zahtevani in omogočeni naslednji dodatki (addons):
- `dns`
- `hostpath-storage`
- `ingress` (Nginx)
- `cert-manager`

---

## Ključne Kubernetes lastnosti

### 1. High Availability
PHP storitev je konfigurirana s **3 replikami** (`replicas: 3`). Kubernetes samodejno razporeja obremenitev med te pod-e. Če kateri izmed pod-ov odpove, ga Kubernetes takoj nadomesti z novim.

### 2. Health Check
Vsi ključni servisi uporabljajo liveness in readiness probe:
- **Readiness Probe**: Preveri, če je aplikacija pripravljena na promet. Pri PHP preverjamo FastCGI port (9000), pri Caddy-ju pa namenski `/health` endpoint. S tem preprečimo, da bi uporabnik dobil napako, dokler se baza in PHP popolnoma ne zaženeta.
- **Liveness Probe**: Preverja, če je aplikacija še vedno živa. Če PHP proces zamrzne, Kubernetes pod avtomatsko ponovno zažene.
- **Parametri**: Nastavljeni so z `initialDelaySeconds`, da aplikaciji omogočimo varen zagon, preden začnemo s preverjanjem.

### 3. Rolling Updates
Uporabljena je strategija `RollingUpdate` s parametri:
- `maxSurge: 1`: Kubernetes najprej zažene en nov pod.
- `maxUnavailable: 0`: Noben star pod se ne ugasne, dokler novi ni popolnoma pripravljen (Ready).
To zagotavlja **0-downtime upgrade**, saj je aplikacija vedno dosegljiva preko vsaj 3 delujočih replik.

### 4. Avtomatiziran TLS (Cert-manager)
Uporabljamo `cert-manager` in `ClusterIssuer`, ki samodejno komunicirata z **Let's Encrypt**. Certifikati se avtomatsko pridobijo preko HTTP-01 izziva in se shranijo v Kubernetes Secret, ki ga Ingress uporabi za varno HTTPS povezavo.

---

## CI/CD - GitHub Actions

Pipeline je posodobljen za K8s:
- Gradi se samo **PHP multi-stage image**, saj vsi ostali servisi uporabljajo uradne slike s ConfigMap konfiguracijami.
- Slike se samodejno objavljajo v **GHCR** (GitHub Container Registry).

---

## Demo (Rolling Update)

### Video / Asciinema
[![asciicast](https://asciinema.org/a/ngqYiQ3OdeTKGRZj.svg)](https://asciinema.org/a/ngqYiQ3OdeTKGRZj)

