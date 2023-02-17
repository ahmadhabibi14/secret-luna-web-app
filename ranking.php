<?php
include('app/layout/head.php');

?>
<div style="top:130px;left: 95px;margin: 0;position: absolute;transform: translate(95px);width: 47.6%;">
<div class="container col">
<div class="row-2 col-9">
	<div class="box-content">
		<div class="register-parent">
			<div class="content-title">
						<h1>Ranking</h1>
						<div class="switch">( Switch to Guilds )</div>	
					</div>
			<table class="ranking-table-full player">
				<tr style="text-align: center;r">
					<th>#</th>
					<th>Name</th>
					<th>Lvl</th>
					<th>Job</th>
					<th>Time Played</th>
				</tr>
				<?php
				$no = 1;
				$stmt = $game->prepare("with Rank as (
SELECT     character_name, character_grade , character_job1 ,character_playtime , tmm.KillMonNumTotal,
ROW_NUMBER() OVER (ORDER BY character_grade DESC , character_expoint desc , tmm.KillMonNumTotal DESC) AS Seq
FROM tb_character tb join tb_monstermeter tmm on tmm.playerid = tb.character_idx WHERE left(character_name, 1) <> '@'
)
select * from rank where seq>= 1 and seq < 1+50");
				$stmt->execute();
				while($stmts=$stmt->fetchObject())
				{
					?>
					<tr style="text-align: center">
						<td><?php echo $no++ ?></td>
						<td><?php echo $stmts->character_name ?></td>
						<td><?php echo $stmts->character_grade ?></td>
						<td><?php echo $stmts->character_job1 ?></td>
						<td><?php echo $stmts->character_playtime ?></td>
					</tr>
					<?php
				}
				?>
			</table>	
			<table class="ranking-table-full guild">
				<tr style="text-align: center;">
					<th>#</th>
					<th>Guild Name</th>
					<th>Guild Level</th>
					<th>Guild Master</th>
					<th>Points</th>
				</tr>
				<?php
				$no = 1;
				$stmt = $game->prepare("with Guild2 as (
select guildname , mastername , guildlevel,score,ROW_NUMBER() OVER (order by guildlevel DESC) as seq from tb_guild 
)
select * from guild2 where seq>= 1 and seq < 1+10");
				$stmt->execute();
				while($stmts=$stmt->fetchObject())
				{
					?>
					<tr style="text-align: center">
						<td><?php echo $no++ ?></td>
						<td><?php echo $stmts->guildname ?></td>
						<td><?php echo $stmts->guildlevel ?></td>
						<td><?php echo $stmts->mastername?></td>
						<td><?php echo number_format($stmts->score , 0)?></td>
					</tr>
					<?php
				}
				?>
			</table>

		</div>
	</div>
</div>
<?php include('app/layout/side.php');?>
</div>
</div>

<?php
include("app/layout/foot.php");
?>
</body>