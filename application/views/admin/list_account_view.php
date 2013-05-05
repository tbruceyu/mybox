<div align="center" style="margin-top:80px">
    <table id="dg" title="Account manage" class="easyui-datagrid" style="width:700px;height:400px"  
            url="<?=site_url('admin/account/list_account/1')?>"  
            toolbar="#toolbar" pagination="true"  
            rownumbers="true" fitColumns="true" singleSelect="true">  
        <thead>  
            <tr>  
                <th field="id" width="20" align="center">ID</th>  
                <th field="username" width="50" align="center">UserName</th>  
                <th field="password" width="30" align="center">PassWord</th>  
                <th field="type" width="20" align="center">Type</th>  
                <th field="client_id" width="110" align="center">ClientId</th>  
                <th field="client_secret" width="110" align="center">ClientPw</th>  
            </tr>  
        </thead>  
    </table> 
    <div id="toolbar">  
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newUser()">NewuUser</a>  
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editUser()">EditUser</a>  
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="destroyUser()">DeleteUser</a>  
    </div>  
      
    <div id="dlg" class="easyui-dialog" style="width:400px;height:280px;padding:10px 20px"  
            closed="true" buttons="#dlg-buttons">  
        <form id="fm" method="post" novalidate>  
            <div class="fitem">  
                <label>ID:</label>  
                <input name="id" class="easyui-validatebox" required="true">  
            </div>  
            <div class="fitem">  
                <label>UserName:</label>  
                <input name="username" class="easyui-validatebox" required="true">  
            </div>  
            <div class="fitem">  
                <label>Password:</label>  
                <input name="password" class="easyui-validatebox" required="true">  
            </div>  
            <div class="fitem">  
				<label>Type:</label> 
				<input name="type" class="easyui-validatebox" required="true"> 
            </div>
            <div class="fitem">  
                <label>ClientId:</label>  
                <input name="client_id" class="easyui-validatebox" required="true">  
            </div>  
            <div class="fitem">  
                <label>ClientPw:</label>  
                <input name="client_secret" class="easyui-validatebox" required="true">  
            </div>    
		</form> 
    </div>  
    <div id="dlg-buttons">  
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="saveUser()">Ok</a>  
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')">Cancel</a>  
    </div>  
    <script type="text/javascript">  
        var url;  
        function newUser(){  
            $('#dlg').dialog('open').dialog('setTitle','NewUser');  
            $('#fm').form('clear');  
            url = '<?=site_url('admin/account/add_account')?>';  
        }  
        function editUser(){  
            var row = $('#dg').datagrid('getSelected');  
            if (row){  
                $('#dlg').dialog('open').dialog('setTitle','EditUser');  
                $('#fm').form('load',row);  
                url = '<?=site_url('admin/account/update_account')?>?id='+row.id;  
            }  
        }  
        function saveUser(){  
            $('#fm').form('submit',{  
                url: url,  
                onSubmit: function(){  
                    return $(this).form('validate');  
                },  
                success: function(result){  
                    var result = eval('('+result+')');  
                    if (result.errorMsg){  
                        $.messager.show({  
                            title: 'Error',  
                            msg: result.errorMsg  
                        });  
                    } else {  
                        $('#dlg').dialog('close');      // close the dialog  
                        $('#dg').datagrid('reload');    // reload the user data  
                    }  
                }  
            });  
        }  
        function destroyUser(){  
            var row = $('#dg').datagrid('getSelected');  
            if (row){  
                $.messager.confirm('Notice','Do you whant to save it?',function(r){  
                    if (r){  
                        $.post('<?=site_url('admin/account/destroy_account')?>',{id:row.id},function(result){  
                            if (result.success){  
                                $('#dg').datagrid('reload');    // reload the user data  
                            } else {  
                                $.messager.show({   // show error message  
                                    title: 'Error',  
                                    msg: result.errorMsg  
                                });  
                            }  
                        },'json');  
                    }  
                });  
            }  
        }  
    </script>  
    <style type="text/css">  
        #fm{  
		margin:0;  
		padding:10px 30px;  
		 }  
		.ftitle{  
		font-size:14px;  
	    font-weight:bold;  
		padding:5px 0;  
		margin-bottom:10px;  
		border-bottom:1px solid #ccc;  
		}
		.fitem{  
		margin-bottom:5px;  
	    }
		.fitem label{display:inline-block;                                                                                                                                     width:80px;  
		}