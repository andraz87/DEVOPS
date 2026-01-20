# Kubernetes verzija aplikacije (PHP-FPM + MySQL + Redis + Caddy) na Minikube

## Okolje
- Minikube je lokalni Kubernetes cluster (tece na Ubuntu VM).
- Upravljanje poteka prek `kubectl`.
- `kompose` je bil uporabljen za zacetno pretvorbo iz `docker-compose.yaml` v K8s manifeste.

## Kompose in manifesti
Manifesti so v mapi `./kompose` in so vecinoma generirani z:

```bash
kompose convert -f docker-compose.yaml -o kompose
```

Seznam manifestov v `./kompose`:
- caddy-caddyfile-configmap.yaml
- caddy-cm0-configmap.yaml
- caddy-deployment.yaml
- caddy-service.yaml
- caddy-data-persistentvolumeclaim.yaml
- caddy-config-persistentvolumeclaim.yaml
- caddy-claim1-persistentvolumeclaim.yaml
- mysql-deployment.yaml
- mysql-service.yaml
- mysql-data-persistentvolumeclaim.yaml
- mysql-claim2-persistentvolumeclaim.yaml
- mysql-cm1-configmap.yaml
- redis-deployment.yaml
- redis-service.yaml
- php-deployment.yaml
- php-service.yaml

Opombe:
- `kompose` ni ustvaril Service objektov za vse servise, ker v `docker-compose` niso bili izpostavljeni `ports`. Zato so rocno dodani Service manifesti za:
  - `php` (port 9000, da Caddy uporablja `php_fastcgi php:9000`)
  - `mysql` (za interno dosegljivost)
  - `redis` (za interno dosegljivost)
- Za trajno shrambo so uporabljeni PersistentVolumeClaim-i (PVC), npr. za MySQL data ter Caddy data/config.
- Caddy konfiguracija je v ConfigMapu `caddy-caddyfile`.

## Zagon
Koraki za zagon na Minikube:

```bash
minikube start --driver=docker
kubectl apply -f kompose
kubectl get pods
kubectl get svc
```

## Dostop do aplikacije
Ker Minikube z docker driverjem na VM ne routa NodePort prometa iz javnega IP-ja, uporabim port-forward:

```bash
sudo KUBECONFIG=$HOME/.kube/config kubectl port-forward --address 0.0.0.0 svc/caddy 80:80
```

Nato odprem:
- `http://<VM_PUBLIC_IP>/`
- ali `http://<domena>/`

Opomba: ce brskalnik sili na HTTPS, je to lahko HSTS/HTTPS-only nastavitev. Za test uporabi incognito ali pocisti HSTS za domeno.

## Trenutno stanje (primer)

```text
NAME                     READY   STATUS    RESTARTS   AGE
caddy-...                1/1     Running   0          ...
mysql-...                1/1     Running   0          ...
php-...                  1/1     Running   0          ...
php-...                  1/1     Running   0          ...
php-...                  1/1     Running   0          ...
redis-...                1/1     Running   0          ...
```

## Kratka arhitektura
- Caddy je reverse proxy (HTTP) in uporablja `php_fastcgi` na Service `php` (port 9000).
- PHP se povezuje na MySQL (Service `mysql`) in Redis (Service `redis`) prek cluster DNS.
- Podatki za MySQL so na PVC (trajna shramba).

## Kaj je se TODO za koncno oddajo
- Ingress + TLS (cert-manager) na javnem IP (production-like)
- readiness/liveness probes
- rolling update in blue/green za izbran service
- multi-stage custom image build
- CI/CD (npr. GitHub Actions) build/tag/push
