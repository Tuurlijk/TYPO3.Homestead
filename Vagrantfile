# -*- mode: ruby -*-
# vi: set ft=ruby :

# Examples:
# https://gitlab.com/gitlab-org/cookbook-gitlab/blob/master/Vagrantfile#L80
# http://www.tomaz.me/2013/10/14/solution-for-ansible-git-module-getting-stuck-on-clone.html

# You can ask for more memory and cores when creating your Vagrant machine:
# VAGRANT_MEMORY=2048 VAGRANT_CORES=4 vagrant up
MEMORY = ENV['VAGRANT_MEMORY'] || '2048'
CORES = ENV['VAGRANT_CORES'] || '1'

# Network
PRIVATE_NETWORK = ENV['VAGRANT_PRIVATE_NETWORK'] || '192.168.12.12'
HOSTNAME = ENV['VAGRANT_HOSTNAME'] || 'typo3.homestead'

# Determine if we need to forward ports
FORWARD = ENV['VAGRANT_FORWARD'] || '1'

# Vagrantfile API/syntax version. Don't touch unless you know what you're doing!
VAGRANTFILE_API_VERSION = '2'

# Boot the box with the gui enabled
DEBUG = ENV['VAGRANT_DEBUG'] || false

# Generate SSH keys for these known hosts
knownHosts = [ 'github.com' ]

Vagrant.configure(VAGRANTFILE_API_VERSION) do |config|
	config.vm.hostname = HOSTNAME
	config.vm.box = "ubuntu/trusty64"
	config.vm.boot_timeout = 120
	config.hostsupdater.aliases = [HOSTNAME]

	# Network
	config.vm.network :private_network, ip: PRIVATE_NETWORK
	if FORWARD.to_i > 0
		config.vm.network :forwarded_port, guest: 80, host: 8080
		config.vm.network :forwarded_port, guest: 3306, host: 33060
		config.vm.network :forwarded_port, guest: 5432, host: 54320
		config.vm.network :forwarded_port, guest: 35729, host: 35729
	end

	# SSH
	config.ssh.forward_agent = true
	config.ssh.shell = "bash -c 'BASH_ENV=/etc/profile exec bash'" # avoids 'stdin: is not a tty' error.
	config.vm.provision "shell", inline: "echo -e '#{File.read("#{Dir.home}/.ssh/id_rsa.pub")}' >> '/home/vagrant/.ssh/authorized_keys'"
	config.vm.provision "shell", inline: "echo -e '#{File.read("#{Dir.home}/.ssh/id_rsa")}' > '/home/vagrant/.ssh/id_rsa'"
	config.vm.provision "shell", inline: "touch /home/vagrant/.ssh/known_hosts"
	config.vm.provision "shell", inline: "chown -R vagrant:vagrant /home/vagrant/.ssh"
	config.vm.provision "shell", inline: "su vagrant -c 'ssh-keygen -R #{PRIVATE_NETWORK}'"
	config.vm.provision "shell", inline: "ssh-keyscan #{PRIVATE_NETWORK} >> /home/vagrant/.ssh/known_hosts"

	# SSH known hosts
	knownHosts.each do |host|
		config.vm.provision "shell", inline: "su vagrant -c 'ssh-keygen -R #{host}'"
		config.vm.provision "shell", inline: "ssh-keyscan #{host} >> /home/vagrant/.ssh/known_hosts"
	end

	# Virtualbox
	config.vm.provider :virtualbox do |v|
		v.gui = !!DEBUG

		v.customize [
			"modifyvm", :id,
			"--cpuexecutioncap", "90",
			"--chipset", "ich9",
			"--cpus", CORES.to_i,
			"--memory", MEMORY.to_i,
			"--natdnshostresolver1", "on"
			]

		if CORES.to_i > 1
			v.customize ["modifyvm", :id, "--ioapic", "on"]
		end
	end

	# Vmware Fusion
	config.vm.provider :vmware_fusion do |v, override|
		override.vm.box = "trusty64_fusion"
		override.vm.box_url = "http://files.vagrantup.com/trusty64_vmware_fusion.box"
		v.vmx["memsize"] = MEMORY.to_i
		v.vmx["numvcpus"] = CORES.to_i
	end

	# Parallels
	config.vm.provider :parallels do |v, override|
		v.customize ["set", :id, "--memsize", MEMORY, "--cpus", CORES]
	end

	# Ansible | http://docs.ansible.com/playbooks_best_practices.html
	config.vm.provision "ansible" do |ansible|
		ansible.verbose = "v"
		ansible.playbook = "site.yml"
		ansible.limit = "all"
		ansible.raw_arguments = ENV['ANSIBLE_ARGS']
		ansible.extra_vars = {
			private_interface: PRIVATE_NETWORK,
			hostname: HOSTNAME
		}
	end

	# Synced Folders
	config.vm.synced_folder ".", "/vagrant", disabled: true
	config.vm.synced_folder "~/Projects/DonationBasedHosting", "/var/www"

	# Use NFS for the shared folder
	#config.vm.synced_folder "~/Projects/DonationBasedHosting", "/var/www",
	#	id: "core",
	#	:nfs => true,
	#	:mount_options => ['nolock,vers=3,tcp,noatime']
end
