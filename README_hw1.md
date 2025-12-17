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

### Asciinema

[![asciicast](https://asciinema.org/a/GlW79RXtr4XVBkWbfLyJxfobJ.svg)](https://asciinema.org/a/GlW79RXtr4XVBkWbfLyJxfobJ)

### Slike
![terminal_ls](slike/slika1.png)
![aplikacija_ssh_port_forward](slike/slika2.png)
![postman_request_1](slike/slika3-%201zahtevek.png)
![postman_request_2](slike/slika4-2zahtevek.png)

## Verzija 2: Multipass / cloud-init

**Namestitev**

- ```$ ./cloud_init.sh```
- Paketni stack: Apache2, MySQL, PHP, libapache2-mod-php, php-mysql, Redis, php-redis
- (optional) ssh port forwarding


**Predpogoji**

- Multipass
- Se nahajaš v cloud_init direktoriju


## SSL

ukaz za podpisovaje svojih certifikatov:
pojdi v ./certs
openssl req -x509 -newkey rsa:4096 -nodes   -keyout server.key -out server.crt -days 365   -subj "/CN=[JAVNI_IP]"