![](https://upload-images.jianshu.io/upload_images/8869373-de67772e61ddcea9.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

## GreenDao 简介
![](https://upload-images.jianshu.io/upload_images/8869373-0fe2f8c103171c0e.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

GreenDAO 是一款开源的面向 Android 的轻便、快捷的 ORM 框架，将 Java 对象映射到 SQLite 数据库中，我们操作数据库的时候，不在需要编写复杂的 SQL语句， 在性能方面，GreenDAO 针对 Android 进行了高度优化， 最小的内存开销 、依赖体积小 同时还是支持数据库加密。

GreenDAO 官网地址：[http://greenrobot.org/greendao/](http://greenrobot.org/greendao/)

## GreenDao 特征

**1、对象映射（ ORM）**

GreenDAO 是ORM 框架，可以非常便捷的将Java 对象映射到 SQLite 数据库中保存。

**2、高性能**

ORM 框架有很多，比较著名的有 OrmLite ， ActiveAndroid , Realm 等，性能也不一样，下图是 GreenDao 官方给出的性能对比。
![](https://upload-images.jianshu.io/upload_images/8869373-8521609faa6b76b0.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)


**3、支持加密**

GreenDao 是支持加密的，可以安全的保存用户数据。

**4、轻量级**

GreenDao 核心库小于100k ，所以我们并不会担心添加 GreenDao 后 APK 大小会变的是否庞大。

**5、支持 protocol buffer(protobuf) 协议**

GreenDao 支持 protocol buffer(protobuf) 协议数据的直接存储，如果你通过 protobuf 协议与服务器交互，将不需要任何的映射。

**6，代码生成**

greenDAO 会根据配置信息自动生成核心管理类以及 DAO 对象

**7，开源**

greenDAO 是开源的，我们可以在github 上下载源码，学习。github 地址：[https://github.com/greenrobot/greenDAO](https://github.com/greenrobot/greenDAO)


## 核心类介绍
### DaoMaster：
使用 greenDAO 的入口点。DaoMaster 负责管理数据库对象(SQLiteDatabase)和 DAO 类(对象)，我们可以通过它内部类 OpenHelper 和 DevOpenHelper SQLiteOpenHelper 创建不同模式的 SQLite 数据库。

### DaoSession :
管理指定模式下的所有 DAO 对象，DaoSession提供了一些通用的持久性方法比如插入、负载、更新、更新和删除实体。

### XxxDAO :
每个实体类 greenDAO 多会生成一个与之对应DAO对象，如：User 实体，则会生成一个一个UserDao 类

### Entities
可持久化对象。通常, 实体对象代表一个数据库行使用标准 Java 属性(如一个POJO 或 JavaBean )。

### 核心类之间的关系
![](https://upload-images.jianshu.io/upload_images/8869373-6edfb61b11459af1.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

## 集成 GreenDAO
### 设置仓库与插件（Project： build.gradle）
```gradle
buildscript {
    repositories {
        jcenter()
        mavenCentral() // add repository
    }
    dependencies {
        classpath 'com.android.tools.build:gradle:2.3.2'
        classpath 'org.greenrobot:greendao-gradle-plugin:3.2.2' // add plugin
    }
}
```

### 配置依赖 ( Module:app build.gradle )
```gradle
apply plugin: 'com.android.application'
apply plugin: 'org.greenrobot.greendao' // apply plugin

dependencies {
    compile 'org.greenrobot:greendao:3.2.2' // add library

    // This is only needed if you want to use encrypted databases
    compile 'net.zetetic:android-database-sqlcipher:3.5.6'//加密库依赖（可选项）
}
```

### 配置数据库相关信息 ( Module:app build.gradle )
```gradle
greendao {
    schemaVersion 1 //数据库版本号
    daoPackage 'com.speedystone.greendaodemo.db'// 设置DaoMaster、DaoSession、Dao 包名
    targetGenDir 'src/main/java'//设置DaoMaster、DaoSession、Dao目录
}
```


## 快速入门
我们写一个简单的实体类（User），测试一下
```java
package com.speedystone.greendaodemo.model;

import org.greenrobot.greendao.annotation.Entity;
import org.greenrobot.greendao.annotation.Id;

/**
 * Created by Speedy on 2017/6/30.
 */
@Entity
public class User {

    @Id
    private long id;

    private String name;

    private int age;

    //此处省略了getter,setter 方法
}
```

点击 Make Project（或者 Make Moudle ‘App’） 编译一下工程 。如果配置正确，会在配置的包目录下自动会生成 DaoMaster，DaoSession 和 UserDao 类 。

![image.png](https://upload-images.jianshu.io/upload_images/8869373-f38a07f5ee540cfd.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

初始化 GreenDao ( 通常初始化代码写在我们的 Application 类中)

![](https://upload-images.jianshu.io/upload_images/8869373-943192c7c64f2ef1.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

### 获取 UserDao
```java
 MyApp myApp = (MyApp) getApplication();
 DaoSession daoSession =  myApp.getDaoSession();
 UserDao userDao = daoSession.getUserDao();
```

## 保存记录
```java
User user = new User();
user.setUserId(1);
user.setName("小明");
user.setAge(16);

userDao.insert(user);
```
```java
 User user = new User();
 user.setUserId(1);
 user.setName("小明");
 user.setAge(16);

 //插入或者替换
 userDao.insertOrReplace(user);
```

### 删除记录
```java
public void delete(User user){
    userDao.delete(user);
}

public void deleteByUserId(long userid){
     userDao.deleteByKey(1L);
}
```


### 更新记录
```java
public void update(User user){
    userDao.update(user);
}
```


### 查询记录
```java
public List<User> query(){
    return userDao.loadAll();// 查询所有记录
}

public User query2(){
        return userDao.loadByRowId(1);//根据ID查询
}

public List<User> query2(){
        return userDao.queryRaw("where AGE>?","10");//查询年龄大于10的用户
}

//查询年龄大于10的用户
public List<User> query4(){
    QueryBuilder<User> builder = userDao.queryBuilder();
    return  builder.where(UserDao.Properties.Age.gt(10)).build().list();
}
```

## 注解详解
### @Entity
表明这个实体类会在数据库中生成一个与之相对应的表

属性：
- schema：告知GreenDao当前实体属于哪个 schema
- schema active：标记一个实体处于活跃状态，活动实体有更新、删除和刷新方法
- nameInDb：在数据库中使用的别名，默认使用的是实体的类名，
- indexes：定义索引，可以跨越多个列
- createInDb：标记创建数据库表（默认：true）
- generateConstructors 自动创建全参构造方法（同时会生成一个无参构造方法）（默认：true）
- generateGettersSetters 自动生成 getters and setters 方法（默认：true）

```java
@Entity(
        schema = "myschema",
        active = true,
        nameInDb = "AWESOME_USERS"，
        indexes = {
                @Index(value = "name DESC", unique = true)
        },
        createInDb = true,
        generateConstructors = false,
        generateGettersSetters = true
)
public class User {
  ...
}
```

### @Id
对应数据表中的 Id 字段

### @Index
使用@Index作为一个属性来创建一个索引，默认是使用字段名

```java
@Entity
public class User {
    @Id 
    private Long id;

    @Index(unique = true)
    private String name;
}
```

### @Property
设置一个非默认关系映射所对应的列名，默认是使用字段名,例如：@Property(nameInDb = “userName”)

### @NotNull
设置数据库表当前列不能为空

### @Transient
添加此标记后不会生成数据库表的列

### @Unique
表名该属性在数据库中只能有唯一值
```java
@Entity
public class User {
    @Id 
    private Long id;
    @Unique
    private String name;
}
```

### @OrderBy
更加某一字段排序 ，例如：@OrderBy(“date ASC”)


### @ToOne
表示一对一关系

```java
@Entity
public class Order {

    @Id private Long id;

    private long customerId;

    @ToOne(joinProperty = "customerId")
    private Customer customer;
}

@Entity
public class Customer {
    @Id 
    private Long id;
}
```

### @ToMany
定义一对多个实体对象的关系

```java
@Entity
public class Customer {
    @Id private Long id;

    @ToMany(referencedJoinProperty = "customerId")
    @OrderBy("date ASC")
    private List<Order> orders;
}

@Entity
public class Order {
    @Id private Long id;
    private Date date;
    private long customerId;
}
```

## 参考资料
- http://greenrobot.org/greendao/
- https://juejin.im/post/5959b5bcf265da6c4d1bb245
- https://www.jianshu.com/p/1ceea4b3f94f
- https://www.cnblogs.com/whoislcj/p/5651396.html
- https://blog.csdn.net/speedystone/article/details/72769793
- https://github.com/greenrobot/greenDAO


## About
![](https://upload-images.jianshu.io/upload_images/8869373-901590e019f6f85b.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

---------------
了解更多有趣的操作请关注我的微信公众号：DealiAxy
每一篇文章都在我的博客有收录：[blog.deali.cn](http://blog.deali.cn)