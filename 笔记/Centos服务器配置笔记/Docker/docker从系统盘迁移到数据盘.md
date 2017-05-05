# **`Docker从系统盘迁移到数据盘`**

1. 将 /var/lib/docker 移至数据盘

原因： docker运行中产生较大文件，以及pull下来的images会占用很多空间：

注意：在执行前确认docker已经启动，sudo docker info

具体做法：
来源: http://alexander.holbreich.org/2014/07/moving-docker-images-different-partition/

2. 备份 fstab

```
sudo cp /etc/fstab /etc/fstab.$(date +%Y-%m-%d)
```

3. 停止docker， 用rsync同步/var/lib/docker到新位置.

```
sudo service docker stop


sudo mkdir /data/docker


sudo rsync -aXS /var/lib/docker/. /data/docker/


sudo rm -rf /var/lib/docker/*
```



4. 修改fstab，

```
sudo vim /etc/fstab
```


把下面一行添加到fstab里，将新位置挂载到 /var/lib/docker


```
/data/docker /var/lib/docker none bind 0 0
```

类似这样：

```
# <file system> <mount point> <type> <options> <dump> <pass>
# / was on /dev/xvda1 during installation
UUID=af414ad8-9936-46cd-b074-528854656fcd / ext4 errors=remount-ro,barrier=0 0 1
/dev/xvdb1 /data ext4 errors=remount-ro,barrier=0 0 0
/data/docker /var/lib/docker none bind 0 0
```

5. 重新挂载

```
sudo mount -a
```


6. 检查一下

```
sudo df /var/lib/docker/
```


如果成功会是如下输出
Filesystem 1K-blocks Used Available Use% Mounted on
/data/docker 20510332 591672 18853752 4% /var/lib/docker