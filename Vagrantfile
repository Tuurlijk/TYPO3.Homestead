# -*- mode: ruby -*-
# vi: set ft=ruby :

# Vagrantfile API/syntax version. Don't touch unless you know what you're doing!
VAGRANTFILE_API_VERSION = "2"

Vagrant.configure(VAGRANTFILE_API_VERSION) do |config|
  # Configure The Box
  config.vm.box = "chef/ubuntu-14.04"
  config.vm.hostname = "homestead"

  config.vm.network :private_network, ip: "192.168.33.10"

  config.vm.provider "virtualbox" do |vb|
    vb.customize ["modifyvm", :id, "--memory", "2048"]
    vb.customize ["modifyvm", :id, "--natdnsproxy1", "on"]
    vb.customize ["modifyvm", :id, "--natdnshostresolver1", "on"]
  end

  # Configure Port Forwarding
  config.vm.network "forwarded_port", guest: 80, host: 8080
  config.vm.network "forwarded_port", guest: 3306, host: 33060
  config.vm.network "forwarded_port", guest: 5432, host: 54320
  config.vm.network "forwarded_port", guest: 35729, host: 35729

  config.vm.provision :ansible do |ansible|
    ansible.verbose = "v"
    ansible.playbook = "site.yml"
    #ansible.tags = ["target"]
    #ansible.vault_password_file = "vault_pass.txt"
    ansible.raw_arguments = ["--diff"]
    ansible.groups = {
      "local" => ["default"]
    }
  end

end
