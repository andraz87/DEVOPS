Vagrant.configure("2") do |config|

  # kateri distro
  config.vm.box = "generic/ubuntu2204"

  config.vm.provider :libvirt do |lv|
    lv.memory = 1024
    lv.cpus = 2
  end

  # port forwarding na 8080 na host
  config.vm.network "forwarded_port", guest: 80, host: 8080, host_ip: "127.0.0.1"

  # spletna aplikacija je mount-ana na mesto, kjer apache2 vidi projekt
  config.vm.synced_folder "/srv/DEVOPS/app", "/var/www/html/sport-app", type: "9p"

  # nalozi vse potrebne pakete, zazene sql skripto, ki nastavi bazo, ostalo pa itak ze privzeto tece
  config.vm.provision "shell", inline: <<-SHELL
    apt-get update
    apt-get install -y apache2 mysql-server php libapache2-mod-php php-mysql redis-server php-redis
    mysql < /var/www/html/sport-app/sql/db.sql
  SHELL
end
