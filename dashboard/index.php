<?php
include(dirname(__DIR__)."/app/layout/dashboard/head.php");
$account = $member->query("select count(*) as 'all' , (select count(*) from chr_log_info where MONTH(GETDATE()) = MONTH(id_regdate) and YEAR(GETDATE()) = YEAR(id_regdate)) as 'month', 
    (select count(*) from chr_log_info where MONTH(GETDATE()) = MONTH(id_regdate) and YEAR(GETDATE()) = YEAR(id_regdate) and DAY(GETDATE()) = DAY(id_regdate)) as 'today',
    (select count(*) from chr_log_info where MONTH(GETDATE()) = MONTH(id_regdate) and YEAR(GETDATE()) = YEAR(id_regdate) and dateadd(d, (datediff(d, 0, id_regdate)) , 0) = dateadd(d, (datediff(d, 0, GetDate() - 1)) , 0)) as 'yesterday'
    from chr_log_info");
$accounts = $account->fetchObject();
$guild = $game->query("select count(*) as 'total' , 
    (select count(*) from tb_guild where MONTH(GETDATE()) = MONTH(createdate) and YEAR(GETDATE()) = YEAR(createdate)) as 'month',
    (select count(*) from tb_guild where MONTH(GETDATE()) = MONTH(createdate) and YEAR(GETDATE()) = YEAR(createdate) and DAY(GETDATE()) = DAY(createdate)) as 'today' ,
    (select count(*) from tb_guild where MONTH(GETDATE()) = MONTH(createdate) and YEAR(GETDATE()) = YEAR(createdate) and dateadd(d, (datediff(d, 0, createdate)) , 0) = dateadd(d, (datediff(d, 0, GetDate() - 1)) , 0)) as 'yesterday' 
    from tb_guild");
$guilds = $guild->fetchObject();
$log = $web->query("select count(*) as 'total' , 
    (select count(*) from itemlog where MONTH(GETDATE()) = MONTH([date]) and YEAR(GETDATE()) = YEAR([date])) as 'month',
    (select count(*) from itemlog where MONTH(GETDATE()) = MONTH([date]) and YEAR(GETDATE()) = YEAR([date]) and DAY(GETDATE()) = DAY([date])) as 'today' ,
    (select count(*) from itemlog where MONTH(GETDATE()) = MONTH([date]) and YEAR(GETDATE()) = YEAR([date]) and dateadd(d, (datediff(d, 0, [date])) , 0) = dateadd(d, (datediff(d, 0, GetDate() - 1)) , 0)) as 'yesterday' 
    from itemlog");
$logs = $log->fetchObject();
?>


<div class="content pure-u-1 pure-u-md-21-24">
    <div class="header-small">

        <div class="items">
            <h1 class="subhead">Dashboard</h1>
        </div>

        <div class="pure-g">

            <div class="pure-u-1 pure-u-md-1-3">
                <div class="column-block">
                    <div class="column-block-header column-success">
                        <h2>Accounts Registered</h2>
                        <span class="column-block-info"><?php echo $accounts->month; ?><span>this month</span></span>
                    </div>
                    <ul class="column-block-list">
                        <li>Today <span class="buble-success button-small pull-right"><?php echo $accounts->today ?></span></li>
                        <li>Yesterday <span class="buble-secondary button-small pull-right"><?php echo $accounts->yesterday ?></span></li>
                        <li>Total <span class="buble-warning button-small pull-right"><?php echo $accounts->all ?></span></li>
                    </ul>
                </div>
            </div>

            <div class="pure-u-1 pure-u-md-1-3">
                <div class="column-block">
                    <div class="column-block-header column-warning">
                        <h2>Guilds</h2>
                        <span class="column-block-info"><?php echo $guilds->month; ?><span>this month</span></span>
                    </div>
                    <ul class="column-block-list">
                        <li>Today <span class="buble-success button-small pull-right"><?php echo $guilds->today ?></span></li>
                        <li>Yesterday <span class="buble-secondary button-small pull-right"><?php echo $guilds->yesterday ?></span></li>
                        <li>Total <span class="buble-warning button-small pull-right"><?php echo $guilds->total ?></span></li>
                    </ul>
                </div>
            </div>

            <div class="pure-u-1 pure-u-md-1-3">
                <div class="column-block">
                    <div class="column-block-header">
                        <h2>Item Sold</h2>
                        <span class="column-block-info"><?php echo $logs->month ?> <span>this month</span></span>
                    </div>
                    <ul class="column-block-list">
                        <li>Today <span class="buble-success button-small pull-right"><?php echo $logs->today ?></span></li>
                        <li>Yesterday <span class="buble-secondary button-small pull-right"><?php echo $logs->yesterday ?></span></li>
                        <li>Total <span class="buble-warning button-small pull-right"><?php echo $logs->total ?></span></li>
                    </ul>
                </div>
            </div>

        </div>



        <div class="footer">
            <div class="pure-menu pure-menu-horizontal">
                <ul>
                    <li class="pure-menu-item"><a href="http://purecss.io/" class="pure-menu-link">PURE CSS</a></li>
                    <li class="pure-menu-item"><a href="http://fikiruretgeci.com" class="pure-menu-link">FIKIR URETGECI</a></li>
                    <li class="pure-menu-item"><a href="http://pure-themes.com" class="pure-menu-link">PURE THEMES</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
</div>

</body>
</html>
