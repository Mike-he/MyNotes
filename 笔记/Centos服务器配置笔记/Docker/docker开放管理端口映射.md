# **`docker开放管理端口映射`**

#### 管理端口在 /lib/systemd/system/docker.service 文件中将其中第11行的 ExecStart=/usr/bin/dockerd 替换为：

- ExecStart=/usr/bin/dockerd -H tcp://0.0.0.0:2375 -H unix:///var/run/docker.sock -H
    
```
sudo systemctl daemon-reload && sudo service docker restart
```
