<!-- saved from url=(0048)http://m99.nthu.edu.tw/~s9962301/groupReport.htm -->
<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>Midnight Radio</title>
</head>

<body bgcolor="#ccccff">
這是一個簡易型電台網站，主要功能如下：<br><br>
<ul>
		<li>1、點歌系統：在點歌頁點歌後，於主頁面導覽條顯示待播歌單，依序播放</li><br>
		<li>2、檔案系統：可上傳mp3、背景圖、歌詞，在管理後台通過審核後，自動更新點歌頁</li><br>
		<li>3、帳號系統：註冊登入後可使用聊天室與上傳歌曲</li><br>
</ul>
<p style="background-color:#f99;font-size:17pt">網頁前端概述</p>
網頁前端的製作，主要是以Bootstrap Carousel框架為基礎來進行修改。每個分頁皆是以php撰寫，再以Bootstrap提供的css組件美化，Javascript、Jquery製作視覺效果和互動功能的強化、Ajax處理非同步更新區域，綜合以上的應用來達到我們想要的前端效果。網站前端的架構是以主頁面作延伸來設計：<br><br>
<ul>
	<li>
	主頁面用的是Bootstrap Carousel的三頁式水平滑動風格，左頁為歌詞頁，中間頁是歌曲封面和播放器的iframe，右頁是聊天室。</li><br>
	<li>主頁面上方有一固定式的Navigation Bar，提供點歌頁面的連結、待播歌曲清單以及註冊、登入/登出。</li><br>
	<li>點歌頁是採用Bootstrap表格組件顯示的歌曲清單，上傳頁面的連結也在這裡。</li><br>
	<li>聊天室	：</li><br>
	<ul>
		<li>使用者登入後才能聊天，未登入但仍可看到當前對話內容。主要使用PHP來寫檔和讀取資料。讓使用者畫面同步則用Ajax達成。
		</li><br>
		<li>利用Javascipt和Jquery優化聊天輸入區以及顯示文字區的使用體驗。</li>
	</ul>
</ul>
<p style="background-color:#f99;font-size:17pt">網頁後端概述</p>

後端除了註冊登入等基本功能之外，主要任務是要做到聽眾同步，也就是所有的聽眾要聽到相同的聲音，不可以各聽各聽的。<br>
一般可以用串流的方式做到這一點，我們試著只用php和javascript來模擬這種效果：
<br><br>
<ul>
<li>後端要記下每首歌開始播時的server時間，如果有人中途加入就跟server要現在時間，拿來跟開始播時的時間相減，就可以設定自己開始播的時間，跟上其他同時在聽的人。</li><br>
<li>播完一首也會跟後端記下的時間比較，如果差距小於兩分鐘則視為延遲，將其差距設為下首開始播的時間，如此延遲就不會累積。如果大於兩分鐘就視為是第一個播完的人，會直接換歌，不過正在聽的人還是可以順利地把歌聽完，不會受到影響。</li><br>
<li>
這個做法必須確保每首歌的長度都大於兩分鐘，所以我們需要一個額外的審核頁面，審核過的歌曲資料才會從temp_list資料表被移至song_list資料表，供點歌頁面讀取。另外，也必須讓聽眾不能隨意暫停開始或是拉動時間軸，如此便會破壞同步的進行。我們目前只是用一個div擋在播放器的前面而已，希望之後有機會可以客制化專用的播放器，以達到更好的效果。</li><br>
</ul>

<p style="background-color:#f99;font-size:17pt">參考資料</p>
[1] <a href="http://getbootstrap.com/">Bootstrap</a><br>

</body></html>
