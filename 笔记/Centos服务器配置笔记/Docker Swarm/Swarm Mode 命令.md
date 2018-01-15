# Swarm Mode 命令

`使用此命令的客户端和守护程序API必须至少为1.24。`

`使用docker version客户端上的命令来检查您的客户端和守护程序API版本。`

- swarm init
    - `--advertise-addr` 广播地址，格式：<ip | interface> [：port]
        - 示例 `docker swarm init --advertise-addr 192.168.99.121`
        - `192.168.99.121` IP地址为其他子节点可以访问到的地址
        - `docker swarm init` 之后生成连个随机Token，一个是 Worker Token，一个是 Manager Token。
        - 当将新节点加入到集群中时，节点将根据传递加入集群的Token作为Woker或Manager加入。
    - `--autolock` 启用管理器自动锁定（需要解锁密钥才能启动停止的管理器）
        - 这个标志可以使用加密密钥自动锁定管理者。所有管理员存储的私钥和数据将受到输出中打印的加密密钥的保护，如果没有它，将无法访问。因此，为了激活管理器重新启动后保存这个密钥是非常重要的。密钥可以传递`docker swarm unlock`给重新激活管理器。自动锁定可以通过运行来禁用`docker swarm update --autolock=false`。禁用它之后，加密密钥不再需要启动管理器，并且它将在没有用户干预的情况下自行启动。
    - `--availability` 节点的可用性(active | pause | drain)
    - `--cert-expiry` 节点证书的有效期（ns | us | ms | s | m | h）
    - `--data-path-addr` 用于数据路径通信的地址或接口（格式：<ip | interface>）
    - `--dispatcher-heartbeat` 调度员心跳周期（ns | us | ms | s | m | h）
    - `--external-ca` 	一个或多个证书签名端点的规格
    - `--force-new-cluster` 强制从当前状态创建一个新的群集
    - `--listen-addr` 监听地址（格式：<ip | interface> [：port]）
    - `--max-snapshots` 要保留的额外筏快照的数量
    - `--snapshot-interval` Raft快照之间的日志条目数
    - `--task-history-limit` 任务历史保留限制

- swarm join
    - 加入群体作为Node或Manager
    - `--advertise-addr` 广播地址，格式：<ip | interface> [：port]
    - `--availability` 节点的可用性(active | pause | drain)
    - `--data-path-addr` 用于数据路径通信的地址或接口（格式：<ip | interface>）
    - `--listen-addr` 监听地址（格式：<ip | interface> [：port]）
    - `--token` 进入群的令牌
    
- service create
    - 创建一个新的服务
    - `docker service create --name redis --replicas=5 redis:3.0.6`
    - `docker service create --mode global --name redis2 redis:3.0.6`
    - 使用滚动更新策略创建服务
        - `docker service create \
            --replicas 10 \
            --name redis \
            --update-delay 10s \
            --update-parallelism 2 \
            redis:3.0.6`

- service inspect
- service ls
- service rm
- service scale
- service ps
- service update