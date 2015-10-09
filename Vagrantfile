# -*- mode: ruby -*-
# vi: set ft=ruby :

require 'yaml'

path = "#{File.dirname(__FILE__)}"

# Get machine configuration
configuration = {}
if File.exist?(path + '/Configuration/vagrant.yml')
	configuration = YAML::load(File.read(path + '/Configuration/vagrant.yml')) || {}
end

# Setup defaults
sets = ['synced_folders']
sets.each do |element|
	unless configuration.has_key?(element)
		configuration[element] = {}
	end
end
booleans = ['cores', 'debug', 'memory', 'forward_ports', 'private_interface']
booleans.each do |element|
	unless configuration.has_key?(element)
		configuration[element] = false
	end
end

# Get host os type
host = RbConfig::CONFIG['host_os']

# Give VM 1/4 system memory & access to all cpu cores on the host
if host =~ /darwin/
	cpus = `sysctl -n hw.ncpu`.to_i
	# sysctl returns Bytes and we need to convert to MB
	mem = `sysctl -n hw.memsize`.to_i / 1024 / 1024 / 4
elsif host =~ /linux/
	cpus = `nproc`.to_i
	# meminfo shows KB and we need to convert to MB
	mem = `grep 'MemTotal' /proc/meminfo | sed -e 's/MemTotal://' -e 's/ kB//'`.to_i / 1024 / 4
else # sorry Windows folks, I can't help you
	cpus = 1
	mem = 1024
end

# You can ask for more memory and cores when creating your Vagrant machine:
MEMORY = configuration['memory'] || mem
CORES = configuration['cores'] || cpus

# Enforce lower bound of memory to 1024 MB
if MEMORY.to_i < 1024
	MEMORY = 1024
end

# Network
PRIVATE_NETWORK = configuration['private_interface'] || '192.168.144.120'

# Determine if we need to forward ports
FORWARD = configuration['forward_ports'] || 0

# Boot the box with the gui enabled
DEBUG = !!configuration['debug'] || false

# Throw an error if required Vagrant plugins are not installed
# plugins = { 'vagrant-hostsupdater' => nil }
#
# plugins.each do |plugin, version|
# 	unless Vagrant.has_plugin? plugin
# 		error = "The '#{plugin}' plugin is not installed! Try running:\nvagrant plugin install #{plugin}"
# 		error += " --plugin-version #{version}" if version
# 		raise error
# 	end
# end

$script = <<SCRIPT
echo "============================================================="
echo "All done!"
echo ""
echo "You can now try one of these sites:"
echo "- http://1.2.local.neos.io/neos/"
echo "- http://2.0.local.neos.io/neos/"
echo "- http://dev-master.local.neos.io/neos/"
echo "- http://6.2.local.typo3.org/typo3/"
echo "- http://7.5.local.typo3.org/typo3/"
echo "- http://dev-master.local.typo3.org/typo3/"
echo "- http://local.typo3.org:1080/ <- mailcatcher"
echo ""
echo "Username: admin"
echo "Password: supersecret"
echo "============================================================="
SCRIPT

# Vagrantfile API/syntax version. Don't touch unless you know what you're doing!
VAGRANTFILE_API_VERSION = 2

Vagrant.configure(VAGRANTFILE_API_VERSION) do |config|
	config.vm.box = 'Michiel/Development'
	config.vm.boot_timeout = 180
# If you have no Internet access (can not resolve *.local.typo3.org), you can use host aliases:
# 	config.hostsupdater.aliases = [
# 		'6.2.local.typo3.org',
# 		'7.5.local.typo3.org'
# 		]

	# Network
	config.vm.network :private_network, ip: PRIVATE_NETWORK
	if FORWARD.to_i > 0
		config.vm.network :forwarded_port, guest: 80, host: 8080
		config.vm.network :forwarded_port, guest: 3306, host: 33060
		config.vm.network :forwarded_port, guest: 35729, host: 35729
	end

	# SSH
	config.ssh.shell = "bash -c 'BASH_ENV=/etc/profile exec bash'" # avoids 'stdin: is not a tty' error.
	config.ssh.forward_agent = true
	# 	config.vm.provision "shell", inline: "echo -e '#{File.read("#{Dir.home}/.ssh/id_rsa")}' > '/home/vagrant/.ssh/id_rsa'"
	# 	config.ssh.username = "root"
	# 	config.ssh.private_key_path = "phusion.key"

	# Virtualbox
	config.vm.provider :virtualbox do |vb|
		vb.gui = !!DEBUG
		vb.memory = MEMORY.to_i
		vb.customize ["modifyvm", :id, "--cpuexecutioncap", "90"]
		vb.customize ["modifyvm", :id, "--natdnsproxy1", "on"]
		vb.customize ["modifyvm", :id, "--natdnshostresolver1", "on"]
		vb.customize ["modifyvm", :id, "--pae", "on"]
		vb.customize ["modifyvm", :id, "--cpus", CORES.to_i]
		vb.customize ["modifyvm", :id, "--ostype", "Ubuntu_64"]

		# If more cpu's are requested than are available; enable ioapic
		if CORES.to_i > cpus
			vb.customize ["modifyvm", :id, "--ioapic", "on"]
		end
	end

	# Vmware Fusion
	config.vm.provider :vmware_fusion do |v, override|
		override.vm.box = "Michiel/Development"
		v.vmx["memsize"] = MEMORY.to_i
		v.vmx["numvcpus"] = CORES.to_i
	end

	# Parallels
	config.vm.provider :parallels do |v, override|
		v.customize ["set", :id, "--memsize", MEMORY, "--cpus", CORES]
	end

	# Show information what to do after the machine has booted
	config.vm.provision "shell", inline: $script, run: "always"

	# Setup synced folders
	configuration['synced_folders'].each do |folder|
		if host =~ /(darwin|linux)/
			config.vm.synced_folder folder['src'], folder['target'],
				id: folder['name'],
				:nfs => true,
				:mount_options => ['vers=3,udp,noacl,nocto,nosuid,nodev,nolock,noatime,nodiratime'],
				:linux__nfs_options => ['no_root_squash']
		else
			config.vm.synced_folder folder['src'], folder['target']
		end
	end

	# Disable default shared folder
	config.vm.synced_folder ".", "/vagrant", disabled: true

	# Ensure proper permissions for nfs mounts
	config.nfs.map_uid = Process.uid
	config.nfs.map_gid = Process.gid

end
