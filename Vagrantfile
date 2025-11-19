Vagrant.configure("2") do |config|

  # kateri distro
  config.vm.box = "ubuntu/focal64"

  # port forwarding na 8080 na host
  config.vm.network "forwarded_port", guest: 80, host: 8080, host_ip: "127.0.0.1"

  # spletna aplikacija je mount-ana na mesto, kjer apache2 vidi projekt
  config.vm.synced_folder "app", "/var/www/html/sport-app"

  # nalozi vse potrebne pakete, zazene sql skripto, ki nastavi bazo, ostalo pa itak ze privzeto tece
  config.vm.provision "shell", inline: <<-SHELL
    apt-get update
    apt-get install -y apache2 mysql-server php libapache2-mod-php php-mysql
    mysql < /var/www/html/sport-app/sql/db.sql
  SHELL
end
