## SQLite介紹
[SQLite](http://www.sqlite.org/)是一個輕量級的資料庫系統，不需要安裝就可以使用，也可以十分容易的就內嵌於系統內，FireFox就內嵌SQLite，可以在FireFox上直接使用JavaScript來呼叫操作資料庫。

SQLite是由C語言撰寫而已，可以跨Linux及Windows等平台，在Java存取及操作上則可使用JDBC來連線SQLite。

在JDBC連線SQLite上，大概分成二種方式，一種是由Pure-Java來連結資料，另一種則是直接利用Java呼叫C語言撰寫的函式庫，不過在實測上直接呼叫C的函式庫的方式應該是比較快的，不過在無法找到合適C函式庫的平台則可使用Pure-Java版。

[SQLiteJDBC](http://www.xerial.org/trac/Xerial/wiki/SQLiteJDBC)目前查到這個版本是比較有在更新，而且在使用上跟一般的JDBC幾乎是一樣的，上手程式十分簡單。

SQLiteJDBC可以由[這裡](http://www.xerial.org/maven/repository/artifact/org/xerial/sqlite-jdbc/)下載，以下範例是由3.5.7版本製作，提供建立Table、移除Table、查詢、新增、刪除及修改等範例。

## 實例代碼
```java
import java.sql.*;
 
import org.sqlite.SQLiteConfig;
import org.sqlite.SQLiteDataSource;
public class MyTest {
    public Connection getConnection() throws SQLException
    {
        SQLiteConfig config = new SQLiteConfig();
        // config.setReadOnly(true);   
        config.setSharedCache(true);
        config.enableRecursiveTriggers(true);
    
            
        SQLiteDataSource ds = new SQLiteDataSource(config); 
        ds.setUrl("jdbc:sqlite:sample.db");
        return ds.getConnection();
        //ds.setServerName("sample.db");
 
        
    }
    //create Table
    public void createTable(Connection con )throws SQLException{
        String sql = "DROP TABLE IF EXISTS test ;create table test (id integer, name string); ";
        Statement stat = null;
        stat = con.createStatement();
        stat.executeUpdate(sql);
        
    }
    //drop table
    public void dropTable(Connection con)throws SQLException{
        String sql = "drop table test ";
        Statement stat = null;
        stat = con.createStatement();
        stat.executeUpdate(sql);
    }
    
    //新增
    public void insert(Connection con,int id,String name)throws SQLException{
        String sql = "insert into test (id,name) values(?,?)";
        PreparedStatement pst = null;
        pst = con.prepareStatement(sql);
        int idx = 1 ; 
        pst.setInt(idx++, id);
        pst.setString(idx++, name);
        pst.executeUpdate();
        
    }
    //修改
    public void update(Connection con,int id,String name)throws SQLException{
        String sql = "update test set name = ? where id = ?";
        PreparedStatement pst = null;
        pst = con.prepareStatement(sql);
        int idx = 1 ; 
        pst.setString(idx++, name);
        pst.setInt(idx++, id);
        pst.executeUpdate();
    }
    //刪除
    public void delete(Connection con,int id)throws SQLException{
        String sql = "delete from test where id = ?";
        PreparedStatement pst = null;
        pst = con.prepareStatement(sql);
        int idx = 1 ; 
        pst.setInt(idx++, id);
        pst.executeUpdate();
    }
    
    public void selectAll(Connection con)throws SQLException{
        String sql = "select * from test";
        Statement stat = null;
        ResultSet rs = null;
        stat = con.createStatement();
        rs = stat.executeQuery(sql);
        while(rs.next())
        {
            System.out.println(rs.getInt("id")+"\t"+rs.getString("name"));
        }
    }
    public static void main(String args[]) throws SQLException{
        MyTest test = new MyTest();
        Connection con = test.getConnection();
        //建立table
        test.createTable(con);
        //新增資料
        test.insert(con, 1, "第一個");
        test.insert(con, 2, "第二個");
        //查詢顯示資料
        System.out.println("新增二筆資料後狀況:");
        test.selectAll(con);
        
        //修改資料
        System.out.println("修改第一筆資料後狀況:");
        test.update(con, 1, "這個值被改變了!");
        //查詢顯示資料
        test.selectAll(con);
        
        //刪除資料
        System.out.println("刪除第一筆資料後狀況:");
        test.delete(con, 1);
        //查詢顯示資料
        test.selectAll(con);
        
        //刪除table
        test.dropTable(con);
        
        con.close();
        
    }
}
```

## 說明
SQLite並沒有使用者登入的的機制，所以只需要告知要存取的資料庫檔案位置就可以使用了。jdbc:sqlite:sample.db其中sample.db就是檔案名稱，也可指定其路徑位置c:\sample.db。

以下是執行結果：

![image.png](https://upload-images.jianshu.io/upload_images/8869373-6d765ba5e6c34182.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

原本沒有sample.db這個檔案也被自動建立了，在專案目錄底下。

![image.png](https://upload-images.jianshu.io/upload_images/8869373-c0f8c827ac9ab10c.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

## 參考資料
https://blog.yslifes.com/archives/971