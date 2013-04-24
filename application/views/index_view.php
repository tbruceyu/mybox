<body class="easyui-layout" style="overflow-y: hidden"  scroll="no">
	    <script type="text/javascript">
	 	var _menus = {"menus":[
						{"menuid":"1","icon":"icon-sys","menuname":"My Automation",
							"menus":[
									{"menuid":"13","menuname":"My Files","icon":"icon-users","url":"<?=site_url('files/list_files')?>"}
								]
						},
						{"menuid":"8","icon":"icon-sys","menuname":"My Account",
							"menus":[{"menuid":"21","menuname":"Personal Details","icon":"icon-users","url":"demo.html"},
									{"menuid":"22","menuname":"Change Password","icon":"icon-nav","url":"demo1.html"}
								]
						}
				]};
    </script>
<noscript>
<div style=" position:absolute; z-index:100000; height:2046px;top:0px;left:0px; width:100%; background:white; text-align:center;">
    <img src="<?=base_url()?>source/images/noscript.gif" alt='Sorry, Please enable the script support' />
</div></noscript>
    <div region="north" split="true" border="false" style="overflow: hidden; height: 60px;
        background: url(<?=base_url()?>source/images/layout-browser-hd-bg.jpg) #ffffaa repeat-x center 50%;
        line-height: 20px;color: #000000; font-family: Verdana">
        <span style="float:right; padding-right:20px;" class="head">Welcome <a href="#" id="editpass">Change Password</a> <a href="<?=site_url('index/logout')?>" id="loginOut">Logout</a></span>
        <span style="padding-left:10px; font-size: 16px; "><img src="<?=base_url()?>source/images/symantec-log.png" width="198" height="60" align="absmiddle" /> CPI_QA automation</span>
    </div>
    <div region="south" split="true" style="height: 30px; background: #D2E0F2; ">
        <div class="footer">by Bruce</div>
    </div>
    <div region="west" hide="true" split="true" title="Navigation Menu" style="width:180px;" id="west">
<div id="nav" class="easyui-accordion" fit="true" border="false">
		<!--  navigation content -->
				
			</div>

    </div>
    <div id="mainPanle" region="center" style="background: #eee; overflow-y:hidden">
        <div id="tabs" class="easyui-tabs"  fit="true" border="false" >
			<div title="Welcome" style="padding:20px;overflow:hidden; color:red; " >
				<h1 style="font-size:24px;">My Box</h1>
			</div>
		</div>
    </div>

	<div id="mm" class="easyui-menu" style="width:150px;">
		<div id="mm-tabupdate">Refreash</div>
		<div class="menu-sep"></div>
		<div id="mm-tabclose">Close</div>
		<div id="mm-tabcloseall">Close All</div>
		<div id="mm-tabcloseother">Close Others</div>
		<div class="menu-sep"></div>
		<div id="mm-tabcloseright">Close Right Side</div>
		<div id="mm-tabcloseleft">Close Left Side</div>
		<div class="menu-sep"></div>
		<div id="mm-exit">Exit</div>
	</div>