# Docker Compose

## Opis projekta

Platforma za športne aktivnosti omogoča:  
- Registracijo/prijavo uporabnikov (študent, profesor, gost)  
- Pregled aktivnosti in prijavo študentov  
- Kreiranje aktivnosti in označevanje prisotnosti  
- Gostje vidijo samo aktivnosti in prosta mesta  

Aplikacija je zapakirana v več Docker kontejnerjev in nameščena z uporabo Docker Compose.

---

## Arhitektura

Celoten stack je sestavljen iz **štirih različnih storitev**:

- **Web strežnik**: Caddy (HTTPS, TLS)  
- **Aplikacija**: PHP 8.3 (PHP-FPM, multi-stage build)  
- **SQL baza**: MySQL 8.0  
- **Cache**: Redis 7  

Vsaka komponenta teče v svojem kontejnerju.

---

## Tehnologije

- Docker  
- Docker Compose  
- Docker BuildX  
- Multi-stage Docker builds  
- GitHub Actions (CI/CD)  
- Caddy 

---

## Docker Compose Stack

### Storitve

**Caddy**
- web strežnik
- Samodejna TLS konfiguracija (Let's Encrypt)
- Posredovanje PHP zahtev PHP-FPM kontejnerju
- Izpostavljeni porti: `80`, `443`

**PHP**
- PHP 8.3 FPM
- Multi-stage build

**MySQL**
- MySQL 8.0
- Inicializacija baze iz SQL skripte

**Redis**
- Redis 7 Alpine

---

## Persistentni podatki (Volumes)

Uporabljeni so Docker volumes:

- `mysql_data` – podatki MySQL baze  
- `caddy_data` – TLS certifikati  
- `caddy_config` – Caddy konfiguracija  

---

## TLS / HTTPS

HTTPS je omogočen z uporabo **Caddy** strežnika:

- Samodejno pridobivanje in obnavljanje TLS certifikatov
- Konfiguracija preko `APP_URL` okoljske spremenljivke
- Brez ročne nastavitve certifikatov

Primer konfiguracije:

```text
{$APP_URL} {
    root * /var/www/html
    php_fastcgi php:9000
    file_server
}
```
## Multi-stage Build (PHP)

PHP image uporablja multi-stage Docker build:

**Build stage**
- Namestitev build odvisnosti
- Kompilacija PHP razširitev

**Runtime stage**
- Minimalna Alpine image
- Vsebuje samo runtime knjižnice
- Manjša velikost in boljša varnost

## Okoljske spremenljivke

Primer `.env` datoteke:

```text
REDIS_HOST=redis
SQL_HOST=mysql
MYSQL_ROOT_PASSWORD=rootpassword
APP_URL=example.com
```

## CI/CD – GitHub Actions

Za avtomatizacijo build in publish procesov je uporabljen **GitHub Actions workflow**.

### Lastnosti CI/CD pipeline-a
- Trigger:
  - `push` na `main`
  - verzionirani tagi (`vX.Y.Z`)
  - pull request (brez pushanja image-ov)
- Docker BuildX
- Cache z `type=gha`
- Build in push v **GitHub Container Registry (GHCR)**

### Avtomatizirani image-i
- `ghcr.io/andraz87/caddy`
- `ghcr.io/andraz87/php`
- `ghcr.io/andraz87/mysql`

### Tagging strategija

- `latest`
- semver (`vX.Y.Z`, `X.Y`, `X`)
- `sha` commit hash
