;#
;#   Auto generated Fpm configuration
;#       @time: {{ date('H:i:s d-m-Y') }}
;#       @author: hyn.me
;#       @website: {{ $website->id }} "{{ $website->present()->name }}"
;#

;# unique fpm group
[{{ $website->id }}-{{ $website->present()->urlName }}]

;# listening for nginx proxying
listen=/var/run/php/php7.0-fpm.hyn-{{ $config['port'] + $website->id }}.sock
listen.allowed_clients=127.0.0.1


;# user under which the application runs
user={{ $website->websiteUser }}

;# group under which the application runs
group={{ config('webserver.group', 'users') }}

; Set permissions for unix socket, if one is used. In Linux, read/write
; permissions must be set in order to allow connections from a web server. Many
; BSD-derived systems allow connections regardless of permissions.
; Default Values: user and group are set as the running user
;                 mode is set to 0660
listen.owner = www-data
listen.group = www-data
listen.mode = 0666

;# fpm pool management variables
pm=dynamic
pm.max_children         = 20
pm.start_servers        = 5
pm.min_spare_servers    = 5
pm.max_spare_servers    = 10
pm.max_requests         = 20

;# force fpm workers into the following path
chdir                   = {{ base_path() }}
