$(function() {
	$(".file_frame").click(function(){
		alert($(this).children("td").children("input[name='file_id']").val());
	});
	$(".options").click(function() {
		$(this).children("input[name='options']").attr("checked", true);
	});
	//展开收缩选择题选项
	$(".choice_title").click(function() {
		$(this).next(".choice_options").toggle('fast');
	});
	//展开收缩选择题选项
	$(".program_title").click(function() {
		exercise_id = $(this).children("input[name='program']").val();
		$.ligerDialog.open({ height: 1000,width: 1000, url: SITE_URL+'/student/practice/start_do?id='+exercise_id+"&practice="+$("input[name='practice_id']").val(), isResize: true });
	});
	//展开收缩选择题选项
	$(".program_title_done").click(function() {
		exercise_id = $(this).children("input[name='program']").val();
		$.ligerDialog.open({ height: 1000,width: 1000, url: SITE_URL+'/student/practice/show_program?id='+exercise_id+"&practice="+$("input[name='practice_id']").val(), isResize: true });
	});
	
	//获取当前练习id
	var practice_id = $("input[name='practice_id']").val();
	
	//ajax 提交选择题答案
	$("button[name='choice']").click(function() {
		$parent = $(this).parent();
		item = $parent.children('p').children("input[type='radio']:checked").val();
		exercise_id = $parent.children("input[name='exercise_id']").val();
		exercisetype_id = $parent.children("input[name='exercisetype_id']").val();
		if(!item) {
			alert('你还没有选择选项');
		} else {
			$.post(SITE_URL + "student/practice/do_question", {
				practice_id: practice_id,
				exercise_id: exercise_id,
				exercisetype_id: exercisetype_id ,
				answer: item
			}, function(data){
				if(data == 1) {
					$parent.hide('slow');
					$parent.prev(".choice_title").children("a.status").remove();
					$parent.prev(".choice_title").prepend('<a class="status">已选'+ item + '</a>');
				} else {
					alert('提交失败');
				}
			});
		}
	});
	
	//ajax 替换考题
	$("button[name='replace_choice']").click(function(event) {
		$parent = $(this).parent();
		var type = 1;
		var difficulty = $(this).parent().parent().attr("difficulty");
		var where_not = '';
		$("input[name='choice[]']").each(function() {
			if(where_not == '') {
				where_not = $(this).val();
			} else {
				where_not += ('|' + $(this).val());
			}
		});
		var knowledgepoint = $("input[name='choice_knowledgepoint']").val();
		$.post(SITE_URL + "teacher/questions/replace_question", {
				ajax : 1,
				type: type,
				difficulty: difficulty,
				knowledgepoint: knowledgepoint,
				where_not: where_not,
			}, function(data){
				$parent.children("a.title").text(data.title);
				$parent.children("a.extend").text("("+data.difficulty+")");
				$parent.siblings().remove();
				if(data.code != undefined && data.code != '') {
					$parent.after("<pre>"+data.code+"</pre>");
				}
				$options = $parent.parent().next();
				$options.text('');
				$.each(data.options, function(index, item) {
					$options.append('<p class="options">'+item+'</p>');
				});
				$options.append('<input type="hidden" name="choice[]" value="'+data.id+'">');
			}, 'json');
		//阻止事件冒泡
		event.stopPropagation();
	});
	
	$("button[name='replace_program']").click(function(event) {
		$parent = $(this).parent();
		var type = 2;
		var difficulty = $(this).parent().parent().attr("difficulty");
		var where_not = '';
		$("input[name='program[]']").each(function() {
			if(where_not == '') {
				where_not = $(this).val();
			} else {
				where_not += ('|' + $(this).val());
			}
		});
		var knowledgepoint = $("input[name='program_knowledgepoint']").val();
		$.post(SITE_URL + "teacher/questions/replace_question", {
				ajax : 1,
				type: type,
				difficulty: difficulty,
				knowledgepoint: knowledgepoint,
				where_not: where_not,
			}, function(data){
				$parent.children("a.title").text(data.title);
				$parent.children("a.extend").text("("+data.difficulty+")");
				$parent.parent().next().remove();
				$parent.parent().after('<input type="hidden" name="program[]" value="'+data.id+'">');
			}, 'json');
		//阻止事件冒泡
		event.stopPropagation();
	});
	
	$("button[name='re_screening']").click(function() {
		window.location.reload(true);
	});
	
	$("input[name='submit']").click(function() {
		if(confirm('确认完成练习之后将不再有重做的机会，确认提交？')) {
			return true;
		} else {
			return false;
		}
	});
	
	//ajax 替换考题
	$("button[name='replace_choice_view']").click(function(event) {
		$parent = $(this).parent();
		var type = 1;
		var difficulty = $(this).parent().parent().attr("difficulty");
		var where_not = '';
		$("input[name='choice[]']").each(function() {
			if(where_not == '') {
				where_not = $(this).val();
			} else {
				where_not += ('|' + $(this).val());
			}
		});
		var knowledgepoint = $("input[name='choice_knowledgepoint']").val();
		$.post(SITE_URL + "teacher/questions/save_replace_question", {
				ajax : 1,
				type: type,
				difficulty: difficulty,
				knowledgepoint: knowledgepoint,
				where_not: where_not,
			}, function(data){
				$parent.children("a.title").text(data.title);
				$parent.children("a.extend").text("("+data.difficulty+")");
				$parent.siblings().remove();
				if(data.code != undefined && data.code != '') {
					$parent.after("<pre>"+data.code+"</pre>");
				}
				$options = $parent.parent().next();
				$options.text('');
				$.each(data.options, function(index, item) {
					$options.append('<p class="options">'+item+'</p>');
				});
				$options.append('<input type="hidden" name="choice[]" value="'+data.id+'">');
			}, 'json');
		//阻止事件冒泡
		event.stopPropagation();
	});
});