## ustvari kontejnerje

```docker compose up -d```

## SSL

ukaz za podpisovaje svojih certifikatov:

pojdi v ./certs
```openssl req -x509 -newkey rsa:4096 -nodes   -keyout server.key -out server.crt -days 365   -subj "/CN=[TVOJ_IP]"```

https://```[TVOJ_IP]```/index.php/login