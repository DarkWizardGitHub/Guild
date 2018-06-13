<?php
session_start();
// require('./php/header.php');
require('./php/footer.php');
require_once('./class/database_class.php');
$objDatabase = new Database();

require('./debug/function_bbs.php');
//スレッド全件取得

topics_list();


 //スレッド曖昧検索された時(すべて表示される設定)
search_list();


//ページ機能最大6件まで設定
// intpage 現在のページ
// intAllPageNumber トータルのページ数
// intPageNumber １ページあたりの表示件数
if(!empty($_GET['page'])):
	$intPage = $_GET['page'];
else:
	$intPage=" ";
endif;


$intPage = max($intPage, 1);
$intPageNumber = 12;
$intAllPageNumber = ceil(count($_SESSION['topics_list']) / $intPageNumber);
$intPage = min($intPage, $intAllPageNumber);
$intStart = ($intPage - 1) * $intPageNumber;

$topicsLimitSql = "SELECT * FROM `q_and_a` LIMIT ".$intStart.",".$intPageNumber."";
$stmt = $dbh->prepare($topicsLimitSql);
$stmt->execute();

$topics_list = array(); // データがない時のエラーを防ぐ

while (true) {
  $topic = $stmt->fetch(PDO::FETCH_ASSOC);
  if ($topic == false) {
  	break;
  }$topics_list[]=$topic;
}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="./css/bootstrap.css">
	<link rel="stylesheet" href="./css/bbs.css">
	<link rel="stylesheet" href="./css/footer.css">
	<link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">
</head>
<body>
	<div class="container">
		<div class="row">

			<!--画面左のメイン画面-->
			<div class="col-xs-12 col-md-9 col-lg-9 maincontainer">

				<table class="table table-bordered">
					<tr class="kk">
						<th>category</th>
						<th>category</th>
						<th>category</th>
						<th>category</th>
						<th>category</th>
						<th>category</th>
						<th>category</th>
						<th>category</th>
					</tr>
					<tr>
						<th colspan="8" class="search">

							<div class="select">
								<select name="example1">
									<option value="サンプル1">sample1</option>
									<option value="サンプル2">sample2</option>
									<option value="サンプル3">sample3</option>
									<option value="サンプル4">sample4</option>
									<option value="サンプル5">sample5</option>
								</select>
							</div>
							<div class="select">
								<select name="example1">
									<option value="サンプル1">sample1</option>
									<option value="サンプル2">sample2</option>
									<option value="サンプル3">sample3</option>
									<option value="サンプル4">sample4</option>
									<option value="サンプル5">sample5</option>
								</select>
							</div>

							<div class="search-submit">
								<form action="" method="POST">
									<input class="search-text" name="search" type="text" placeholder="Please type the keywords in this space.">
									<input type="submit" class="submit-buttom" value="&emsp;search">
									<i class="fas fa-search search-icon"></i>
								</form>
							</div>

						</th>
					</tr>
				</table>



			<!-- <div class='space'>
        	</div> -->

			<?php if(!empty($_POST['search'])): ?>
				<?php if(isset($_SESSION['search_list'])): ?>

  					<h4 class='sled-title'>search results:<?php echo count($_SESSION['search_list']); ?> &nbsp;&nbsp;
            		<?php foreach($strSearchWord as $strSearchWord):
            			echo $strSearchWord.' ';
            			endforeach; ?>
          			</h4>

          			<!-- <div class='space'>
          			</div> -->

          			<div class="container-fluid">
	    				<div class="row" style="background-color:#323232;">
            				<?php foreach($_SESSION['search_list'] as $search): ?>
            					<div class="col-md-6 col-lg-4">
	    							<div class="box box-margin" style="color:#323232;">
            							<div class='sleds'>

		              						<div>
		                						<a class="sled" href="./debug/question_detail.php?id=<?php echo $search['thread_id']; ?>"><?php echo mb_strimwidth($search['thread_title'],0,100,'    ......'); ?>
		                						</a>
		             						</div>

		  									<p>Reply：<?php echo count_reply($search['thread_id']); ?>
		              						</p>

		  									<p class="contents"><?php echo mb_strimwidth($search['thread_content'],0,   100,'    ......');?>
		              						</p>

		  									<div class='space-small'>
		              						</div>

		              					</div>
		              				</div>
	              				</div>
            				<?php endforeach; ?>
  						</div>
  					</div>

				<?php else: ?>

				  	<h1 class='sled-title'>search results:0 &nbsp;&nbsp; "<?php echo $_POST['search']?>
				  	</h1>

				  	<div class='space'>
          			</div>

				<?php endif; ?>

        	<?php else: ?>

          		<h4 class='sled-title'> All&nbsp;<?php echo $intAllPageNumber."page "?>&nbsp;&nbsp; Page<?php echo $intPage; ?> of <?php echo count($_SESSION['topics_list']); ?>results&nbsp;&nbsp;&nbsp;
					<?php if(($intStart+6)>(count($_SESSION['topics_list']))):
					echo 'the end of the page';
					else:
					echo '12questions';
					endif; ?>
				</h4>

				<!-- <div class='space'>
	        	</div> -->

	        	<div class="container-fluid">
	    			<div class="row" style="background-color:#323232;">
	    				<?php foreach($topics_list as $topic): ?>
	    					<div class="col-md-6 col-lg-4">
	    						<div class="box box-margin" style="color:#323232;">
									<div class='sleds'>

										<div>
											<a class="sled" href="./debug/question_detail.php?id=<?php echo $topic["thread_id"]; ?>"><?php echo mb_strimwidth($topic['thread_title'],0,100,'    ......'); ?>
											</a>
					              		</div>

										<p>Reply：<?php echo count_reply($topic['thread_id']); ?>
										</p>

										<p class="contents"><?php echo mb_strimwidth($topic['thread_content'],0,   100,'    ......');?>
										</p>

					            		<div class='space-small'>
					            		</div>

									</div>
								</div>
							</div>
						<?php endforeach; ?>
					</div>
				</div>

        	<?php endif; ?>

			<div class="page-buttom">

				<?php for($i=1; $i<($intAllPageNumber+1); $i++): ?>
					<?php if($intPage==$i): ?>

              			<p class="no-page"><?php echo $i; ?>
              			</p>

            		<?php else: ?>

						<a class='page' href='bbs.php?page=<?php echo $i ?> & footer=<?php echo $_SESSION['strFooter']; ?>'><?php echo $i; ?>
						</a>

					<?php endif; ?>
				<?php endfor; ?>

			</div>
					<!-- mb_strimwidth (文字列, 開始位置, 丸める幅, 丸めた後の省略文字列, （エンコード(省略可)）日本語だと２カウント) -->


			</div> <!--maincontainer 画面左のメイン画面の閉じタグ-->

				<!-- 画面右のサブ画面-->
				<div class="col-xs-12 col-md-3 col-lg-3 subcontainer">
					<h4 class="ranking-title">Reward Ranking
					</h4>

					<div class="ranking-details">
						<div class="rank ">
							<div class="rank-number">
								<h1>1</h1>
							</div>
							<div class="ranker-detail">

								<p>Keigo kawaguchi</p>
								<p>Point:1007</p>
								<p>Due date:2018,10,31;</p>
							</div>
						</div>
						<div class="rank ranking2">
							<div class="rank-number">

								<h1>2</h1>
							</div>
							<div class="ranker-detail">

								<p>Keigo kawaguchi</p>
								<p>Point:1007</p>
								<p>Due date:2018,10,31;</p>
							</div>
						</div>
						<div class="rank ranking3">
							<div class="rank-number">

								<h1>3</h1>
							</div>
							<div class="ranker-detail">
								<p>Keigo kawaguchi</p>
								<p>Point:1007</p>
								<p>Due date:2018,10,31;</p>
							</div>
						</div>
						<div class="rank ranking4">
							<div class="rank-number">

								<h1>4</h1>
							</div>
							<div class="ranker-detail">
								<p>Keigo kawaguchi</p>
								<p>Point:1007</p>
								<p>Due date:2018,10,31;</p>
							</div>
						</div>
						<div class="rank ranking5">
							<div class="rank-number">
								<h1>5</h1>
							</div>
							<div class="ranker-detail">

								<p>Keigo kawaguchi</p>
								<p>Point:1007</p>
								<p>Due date:2018,10,31;</p>
							</div>
						</div>

						<div class="ranking-more">
							<a>more....</a>


						</div>
					</div>  <!-- ranking-detailの閉じタグ -->



					<!--         右サブ画面の下半分-->
					<h4 class="ranking-title">Reward Ranking
					</h4>

					<div class="ranking-details">
						<div class="rank ranking1">
							<div class="rank-number">
								<h1>1</h1>
							</div>
							<div class="ranker-detail">
								<p>Keigo kawaguchi</p>
								<p>Point:1007</p>
								<p>Due date:2018,10,31;</p>
							</div>
						</div>

						<div class="rank ranking2">
							<div class="rank-number">
								<h1>2</h1>
							</div>
							<div class="ranker-detail">
								<p>Keigo kawaguchi</p>
								<p>Point:1007</p>
								<p>Due date:2018,10,31;</p>
							</div>
						</div>

						<div class="rank ranking3">
							<div class="rank-number">
								<h1>3</h1>
							</div>
							<div class="ranker-detail">
								<p>Keigo kawaguchi</p>
								<p>Point:1007</p>
								<p>Due date:2018,10,31;</p>
							</div>
						</div>

						<div class="rank ranking4">
							<div class="rank-number">
								<h1>4</h1>
							</div>
							<div class="ranker-detail">
								<p>Keigo kawaguchi</p>
								<p>Point:1007</p>
								<p>Due date:2018,10,31;</p>
							</div>
						</div>

						<div class="rank ranking5">
							<div class="rank-number">
								<h1>5</h1>
							</div>
							<div class="ranker-detail">
								<p>Keigo kawaguchi</p>
								<p>Point:1007</p>
								<p>Due date:2018,10,31;</p>
							</div>
						</div>

						<div class="ranking-more">
							<a>more....</a>

						</div>
					</div>  <!-- ranking-detailの閉じタグ -->

				</div> <!-- 右画面subcontainerの閉じタグ -->

		</div> <!-- class="row"の閉じタグ -->
	</div><!-- bodyタグ直下 class="container"の閉じタグ -->

	<!-- footer -->
<?php require('./html/footer.html') ?>


<script type="text/javascript" src="js/jquery-3.3.1.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>
</body>
</html>