### 发布日期：2018-5-14
1. 初始化项目，laravel学习笔记总结 
2. 初始化readme和changelog文件
3. users表的migration迁移和db:seed填充
4. 访问`/dbtest`，测试数据库laravel

### 发布日期：2018-5-15 留存BUG等待修复
1. 修改默认timezone为`Asia/Shanghai`
2. 添加`app/Models`目录存放与数据库交互的模型类
3. 使用查询构造器实现了`users`实体的增删改查
4. 使用`postman`进行`users`实体接口的手工测试
5. 使用了Validate验证前端参数格式(POST UPDATE)

### 发布日期：2018-5-19 修复BUG
1. 修改`users`表的`name`字段限制为唯一`unique`
2. 断网下加载页面太慢，删除了首页默认的`google font`
3. 修复`users`实体插入成功后返回插入数据的BUG
4. 修复`users`实体更新无法获取`$request`的问题

### 发布日期：2018-5-24
- 添加实体`articles`，使用路由知识而非直接使用资源实体类型
- 使用`fzaninotto/faker`库实现对`artiles`的中文数据填充和时间戳维护

### 发布日期：2018-5-26
- 使用自定义验证规则`Validator`过滤`REQUEST`数据
- 使用`Eloquent`实现实体`Article`的增删改查功能API



