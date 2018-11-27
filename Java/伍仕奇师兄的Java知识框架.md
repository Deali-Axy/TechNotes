# BigData/Cloud/ML Notes

## 概念
- 云
    - 公有云
    - 私有云
        - 政务云
        - 公检法司
        - 党政军
- 云服务
    - IAAS层：基础层
    - PAAS层：平台即服务 (虚拟机、容器)
    - SAAS层：软件即服务，资源隔离、多租户
- PAAS层
    - A-PAAS：应用环境平台服务
    - I-PAAS：集成平台服务
        - 应用集成
            - 接口集成
            - 权限集成
            - ESB：企业服务总线
            - SOAP：(`Simple Object Access Protocol`) 简单对象访问协议
        - 用户集成
            - 统一用户
                - 用户信息
                - 组织信息
            - 单点登录 (SSO)
        - 数据集成
            - ETL思想 (数据仓库的基础)
            - **数据总线**
                - 抽取
                - 转换
            - 交换 共享 协同
                - 数据库交换
                - 文件交换
                - 消息交换
                - 服务交换
        - 业务集成
            - 手段
            - 工作流
            - 具体活动
- 大数据面临的问题
    - 成本高
    - 应用效果不明显
    - 不知道怎么用
    - 政府部门要业绩
- 未来热点
    - AI
        - 图像识别
        - 视频识别
    - 区块链
    - 物联网 <-> 大数据
        - 设备
        - 云端


## 项目流程 & 企业结构
- 销售
- 授权技术
    - 解决方案工程师
        - 原型演示
        - 汇报
        - 写方案
        - 做PPT
        - *做预算*
- 招标  (5种)
    > 写招标文件
    - 公开
    - 竞争性
    - 邀标
    - 单一来源采购
    - ...
- 投标
    - 类型
        - 电子标
        - 现场标流程
            - 开标
            - 唱标
            - ...
    - 人员
        - 商务人员
        - 授权技术
        - 技术工程师
        - 销售
- 中标
- 发公告
- 签合同
- 确定项目经理
    >负责项目实施的全过程
    - 职责
        - 项目计划
        - 需求范围
        - 质量
        - 风险
        - 沟通
        - 人力资源管理
        - 配置管理
- 项目启动阶段
    - 工作
        - 与客户沟通
        - 出方案
- 需求阶段
    - 人员
        - 项目经理
        - *需求人员*
    - 工作
        - 需求调研
        - 编制报告
        - **编制需求规格说明书**
- 设计阶段
    - 人员
        - 产品经理
        - 架构师
        - 系统分析师
- 详细设计
    - 人员
        - 系统分析师
        - 程序员
        - 设计师
- 测试阶段
    - 人员
        - 质量保障工程师
        - 测试工程师
- 运维保障
    > 主要和客户沟通奇奇怪怪的问题
    - 人员
        - 实习生
        - ...
- 项目验收
    - 人员
        - 项目经理
    - 工作
        - 编写大量文档



## 技术路线 & 产品路线
- 技术
    - 程序员
    - 架构师
    - 技术总监
- 产品
    - 产品经理
        - 沟通
        - 设计



## 数据
- 存储技术
    - 关系数据库：传统, 国产
    - 大规模并行处理数据库 (MPP)：Greenplum
    - 内存：Redis, memcache
    - 全文数据库：elasticsearch, slor
    - 时序数据库：influxDB, OpenTSDB
    - 列式数据库：HBase
    - 文档数据库：MongoDB
- 计算
    - MPP
    - 批量计算：MapReduce
    - 流式：
        - Spark
        - Storm
- 传输
    - 消息队列
        - AMQP
            - RabbitMQ
            - zeroMQ
            - RocketMQ
        - JMS
            - activeMQ
            - Kafka
    - 其他
        - thrift: 可伸缩的跨语言服务开发框架
        - SOAP
        - Rest

- 分析
    - 大数据
        - Apache Mahout
        - Spark ML
        - R 语言
    - 数据
        - Weka
    - 挖掘
        - TensorFlow
        - DL4J
        - SystemML

## 云计算
- IAAS
    - KVM
    - XEN

- A-PAAS
    - K8S
    - Docker

- I-PAAS
    - 用户
        - RBAC (Role-Based Access Control)
        - SSO
            - **OAuth2**
            - ~~Open2d~~
            - cas
    - 应用 (ESB)
        - Mule ESB
        - JBoss fuse
        - Service Mix
    - 数据
        - ETL
            - kttle
        - 其他
            - informatics
    - 工作流
        - BPMN
            - activiti
            - jbpm
        - 其他
            - OS workflow
            - drools
- SAAS
    - 多租户
        - 分库隔离
        - 数据隔离


## NLP
- analyzer
- HanLP
- 复旦NLP
- 实体提取
- 同义词处理
- 情感分析
- 自动摘要
- 自动聚数
- 相似度分析

### 非结构化数据 -> 结构化
- Grok
- 特征
- OCR
- （看不懂）


## 前端
- SPA：单页应用
    - Ajax
    - MVC
        - AngularJs
        - backbone.js
    - 异步加载
        - RequireJs
        - CommonJs
- 页面
    - Bootstrap
    - ExtJs
    - Liquid.js
- 组件
    - 图表
        - echart
    - 3D
        - WebGL
        - Three.js


## Java基础
- 集成框架
    - Spring Boot
    - Spring Cloud
- 数据
    - Mybatis
    - Hibernate (JPA)
    - Spring Data
- 模板引擎
    - FreeMark
    - velocity
- 文档处理
    - Poi
    - Docx4J
    - iText
- XML
    - Dom4j
    - Stax
    - xPath
    - xsd
- SOAP
    - WSDL
    - DTD
    - SOAP
- OSGI
- Netty