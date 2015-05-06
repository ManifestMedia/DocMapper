# -*- mode: ruby -*-
# vi: set ft=ruby :

Vagrant.configure("2") do |config|

  config.vm.box = "scotch/box"
  config.vm.network "public_network", bridge: 'en0: Wi-Fi (AirPort)', ip: "192.168.1.104"
  config.vm.synced_folder ".", "/var/www", :mount_options => ["dmode=777", "fmode=666"]
  config.vm.define 'DocMapper' do |node|
    config.vm.hostname = "DocMapper"
  end

end