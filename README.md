该项目主要实现的功能为：根据IP地址找到所对应的地理位置信息，[纯真数据库下载链接](http://update.cz88.net/soft/qqwry.rar)

项目包含有三个PHP类文件，主要分别实现下面的功能：

1. IpLocationSeekerBinary
  * 使用PHP代码从纯真IP地址库二进制文件中获取地理位置信息
2. IpLocationSeekerBinaryExtension
  * 使用[qqwry扩展](http://pecl.php.net/package/qqwry)从纯真IP地址库二进制文件中获取地理位置信息
3. IpLocationSeekerSqlite
  * 使用PHP代码从sqlite地址库中获取地理位置信息


使用方法很简单：

    $sqlite_filepath = "/path/to/qqwry/sqlite/db/file/qqwry.sqlite.3";
    $seeker = new IpLocationSeekerSqlite($sqlite_filepath);
    $seeker->seek("222.73.254.90");

除了单纯的IP地理位置信息查找功能，还实现了：

* 纯真地址到中国省份的转换功能，如把“南开大学”这样的地址转变成为“天津”这样的省份，以方便进行统计报表工作
* 纯真二进制文件到sqlite数据库的转换功能

使用以下代码把下载到的纯真数据库二进制文件转换成sqlite：

    $sqlite_filepath = "/path/to/qqwry/sqlite/db/file/qqwry.sqlite.3";
    $qqwry_filepath = "/path/to/qqwry/binary/qqwry.dat";
    $seeker = new IpLocationSeekerBinary($qqwry_filepath);
    $seeker->saveAsSqlite($sqlite_filepath, 3, true);

文件 test/performance_test.php 对所实现的三种IP地理位置查询方法进行了性能测试，测试结果如下：

    [binary]        times:10000     2.53s used
    [binary-e]      times:100000    4.29s used
    [sqlite]        times:100000    5.40s used

使用sqlite跟使用c扩展在查询性能上是比较接近的，都大幅领先于使用PHP实现的二分查找方法。
