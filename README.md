# README PROJEKT

## Opis projekta

Platforma za športne aktivnosti omogoča:  
- Registracijo/prijavo uporabnikov (študent, profesor, gost)  
- Pregled aktivnosti in prijavo študentov  
- Kreiranje aktivnosti in označevanje prisotnosti  
- Gostje vidijo samo aktivnosti in prosta mesta  

## Arhitektura

- HTTP strežnik: Apache2  
- Aplikacija: PHP  
- SQL baza: MySQL  
- Cache: Redis  

## Verzija 1: Vagrant (libvirt)

**Namestitev**  
- Ubuntu 22.04 LTS (box: `generic/ubuntu2204`)  
- Paketni stack: Apache2, MySQL, PHP, libapache2-mod-php, php-mysql, Redis, php-redis  
- ```$ vagrant up```
- (optional) ssh port forwarding

**Predpogoji**  
- Vagrant, libvirt, vagrant-libvirt plugin
- Uporabnik v pravih skupinah (`libvirt`, `libvirt-qemu`)
- Se nahajaš v vagrant direktoriju

## Verzija 2: Multipass / cloud-init

**Namestitev**

- ```$ ./cloud_init.sh```
- Paketni stack: Apache2, MySQL, PHP, libapache2-mod-php, php-mysql, Redis, php-redis
- (optional) ssh port forwarding


**Predpogoji**

- Multipass
- Se nahajaš v cloud_init direktoriju
