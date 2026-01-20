# Kubernetes verzija aplikacije (PHP-FPM + MySQL + Redis + Caddy) na Minikube

## Okolje
- Minikube je lokalni Kubernetes cluster (teče na Ubuntu VM).
- Upravljanje poteka prek `kubectl`.
- `kompose` je bil uporabljen za začetno pretvorbo iz `docker-compose.yaml` v K8s manifeste.

## Kompose in manifesti
Manifesti so v mapi `./kompose` in so večinoma generirani z:

```bash
kompose convert -f docker-compose.yaml -o kompose
```


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


## Trenutno stanje (primer)

```text
NAME                     READY   STATUS    RESTARTS   AGE
caddy-868df9f75f-vtjvc   1/1     Running   0          22m
mysql-b7b6f7bd5-s9css    1/1     Running   0          22m
php-694d974bd9-6rpmb     1/1     Running   0          22m
php-694d974bd9-mb99j     1/1     Running   0          22m
php-694d974bd9-wwvkm     1/1     Running   0          22m
redis-65b79f75f4-ghvr4   1/1     Running   0          22m
```

## Kratka arhitektura
- Caddy je reverse proxy (HTTP) in uporablja `php_fastcgi` na Service `php` (port 9000).
- PHP se povezuje na MySQL (Service `mysql`) in Redis (Service `redis`) prek cluster DNS.
- Podatki za MySQL so na PVC (trajna shramba).

