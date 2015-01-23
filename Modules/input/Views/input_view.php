<?php
    global $path;
?>

<script type="text/javascript" src="<?php echo $path; ?>Modules/input/Views/input.js"></script>
<script type="text/javascript" src="<?php echo $path; ?>Lib/tablejs/table.js"></script>
<script type="text/javascript" src="<?php echo $path; ?>Lib/tablejs/custom-table-fields.js"></script>

<script type="text/javascript" src="<?php echo $path; ?>Modules/input/Views/processlist.js"></script>
<script type="text/javascript" src="<?php echo $path; ?>Modules/input/Views/process_info.js"></script>
<script type="text/javascript" src="<?php echo $path; ?>Modules/feed/feed.js"></script>

<style>
#table input[type="text"] {
         width: 88%;
}

#table td:nth-of-type(1) { width:5%;}
#table td:nth-of-type(2) { width:10%;}
#table td:nth-of-type(3) { width:25%;}

#table td:nth-of-type(7) { width:30px; text-align: center; }
#table td:nth-of-type(8) { width:30px; text-align: center; }
#table td:nth-of-type(9) { width:30px; text-align: center; }
</style>

<br>
<div id="apihelphead"><div style="float:right;"><a href="api"><?php echo _('Input API Help'); ?></a></div></div>

<div class="container">
    <div id="localheading"><h2><?php echo _('Inputs'); ?></h2></div>
    
    <div id="processlist-ui" style="padding:15px; background-color:#efefef; display:none; border-radius: 4px;">
    
    <div style="font-size:30px; padding-bottom:20px; padding-top:18px"><b><span id="inputname"></span></b> config</div>
    <p><?php echo _('Input processes are executed sequentially with the result value being passed down for further processing to the next processor on this processing list.'); ?></p>
    
        <div id="noprocess" class="alert">You have no processes defined</div>
        
        <table id="process-table" class="table table-hover">

            <tr>
                <th style='width:5%;'></th>
                <th style='width:5%;'><?php echo _('Order'); ?></th>
                <th><?php echo _('Process'); ?></th>
                <th><?php echo _('Arg'); ?></th>
                <th></th>
                <th><?php echo _('Actions'); ?></th>
            </tr>

            <tbody id="variableprocesslist"></tbody>

        </table>

        <table class="table">
        <tr><th>Add process:</th><tr>
        <tr>
            <td>
                    <select id="process-select" class="input-large"></select>

                    <span id="type-value" style="display:none">
                        <div class="input-prepend">
                            <span class="add-on value-select-label">Value</span>
                            <input type="text" id="value-input" class="input-medium" placeholder="Type value..." />
                        </div>
                    </span>
                    
                    <span id="type-text" style="display:none">
                        <div class="input-prepend">
                            <span class="add-on text-select-label">Text</span>
                            <input type="text" id="text-input" class="input-large" placeholder="Type text..." />
                        </div>
                    </span>

                    <span id="type-input" style="display:none">
                        <div class="input-prepend">
                            <span class="add-on input-select-label">Node:Input</span>                   
                            <div class="btn-group">
                                <select id="input-select" class="input-medium"></select>
                            </div>
                        </div>
                    </span>

                    <span id="type-schedule" style="display:none">
                        <div class="input-prepend">
                            <span class="add-on schedule-select-label">Schedule</span>
                            <div class="btn-group">
                                <select id="schedule-select" class="input-large"></select>
                            </div>
                        </div>
                    </span>
                    
                    <span id="type-feed"> 
                        <div class="input-prepend">
                            <span class="add-on feed-select-label">Feed</span>
                            <div class="btn-group">
                                <select id="feed-select" class="input-medium"></select>

                                <input type="text" id="feed-name" style="width:140px" placeholder="Type feed name..." />
                                <input type="hidden" id="feed-tag"/>
                            </div>
                        </div>
                        <div class="input-prepend">
                            <span class="add-on feed-engine-label">Engine</span>
                            <div class="btn-group">
                                <select id="feed-engine" class="input-medium">
<?php // All supported engines must be here, removing in process_model.php:get_process_list() arrays hides them from user ?>
                                    <option value=6 >PHPFIWA Fixed Interval With Averaging</option>
                                    <option value=5 >PHPFINA Fixed Interval No Averaging</option>
                                    <option value=2 >PHPTIMESERIES Variable Interval No Averaging</option>
                                    <option value=0 >MYSQL TimeSeries </option>
                                </select>

                                <select id="feed-interval" class="input-mini">
                                    <option value="">Select interval</option>
                                    <option value=5>5s</option>
                                    <option value=10>10s</option>
                                    <option value=15>15s</option>
                                    <option value=20>20s</option>
                                    <option value=30>30s</option>
                                    <option value=60>60s</option>
                                    <option value=120>2m</option>
                                    <option value=300>5m</option>
                                    <option value=600>10m</option>
                                    <option value=1200>20m</option>
                                    <option value=1800>30m</option>
                                    <option value=3600>1h</option>
                                </select>
                            </div>
                        </div>
                    </span>
                    <div class="input-prepend">
                        <button id="process-add" class="btn btn-info" style="border-radius: 4px;"><?php echo _('Add'); ?></button>
                    </div>
            </td>
        </tr>
        <tr>
          <td><div id="description" class="alert alert-info"></div></td>
        </tr>
        </table>
    </div>
    <br>
    
    <div id="table"></div>

    <div id="noinputs" class="alert alert-block hide">
            <h4 class="alert-heading"><?php echo _('No inputs created'); ?></h4>
            <p><?php echo _('Inputs is the main entry point for your monitoring device. Configure your device to post values here, you may want to follow the <a href="api">Input API helper</a> as a guide for generating your request.'); ?></p>
    </div>



<div id="myModal" class="modal hide" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="false">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel"><?php echo _('Delete Input'); ?></h3>
    </div>
    <div class="modal-body">
        <p><?php echo _('Deleting an input will loose its name and configured process list.<br>An new blank input is automatic created by API data post if it does not already exists.'); ?>
        </p>
		<p>
           <?php echo _('Are you sure you want to delete?'); ?>
        </p>
    </div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true"><?php echo _('Cancel'); ?></button>
        <button id="confirmdelete" class="btn btn-primary"><?php echo _('Delete'); ?></button>
    </div>
</div>
</div>
<script>

    var path = "<?php echo $path; ?>";
    
    var firstrun = true;
    var assoc_inputs = {};

    // Extend table library field types
    for (z in customtablefields) table.fieldtypes[z] = customtablefields[z];

    table.element = "#table";
    
    table.fields = {
        //'id':{'type':"fixed"},
        'nodeid':{'title':'<?php echo _("Node"); ?>','type':"fixed"},
        'name':{'title':'<?php echo _("Key"); ?>','type':"text"},
        'description':{'title':'<?php echo _("Name"); ?>','type':"text"},
        'processList':{'title':'<?php echo _("Process list"); ?>','type':"processlist"},
        'time':{'title':'<?php echo _("Last updated"); ?>', 'type':"updated"},
        'value':{'title':'<?php echo _("Value"); ?>','type':"value"},

        // Actions
        'edit-action':{'title':'', 'type':"edit"},
        'delete-action':{'title':'', 'type':"delete"},
        'view-action':{'title':'', 'type':"iconbasic", 'icon':'icon-wrench'}

    }

    table.groupprefix = "Node ";
    table.groupby = 'nodeid';
    table.deletedata = false;
    
    update();

    function update()
    {   
        $.ajax({ url: path+"input/list.json", dataType: 'json', async: true, success: function(data) {
        
            table.data = data;
            table.draw();
            if (table.data.length != 0) {
                $("#noinputs").hide();
                $("#apihelphead").show();
                $("#localheading").show();
            } else {
                $("#noinputs").show();
                $("#localheading").hide();
                $("#apihelphead").hide();
            }
            
            if (firstrun) {
                firstrun = false;
                load_all(); 
            }
        }});
    }

    var updater;
    function updaterStart(func, interval)
    {
        clearInterval(updater);
        updater = null;
        if (interval > 0) updater = setInterval(func, interval);
    }
    updaterStart(update, 10000);
    
    $("#table").bind("onEdit", function(e){
        updaterStart(update, 0);
    });

    $("#table").bind("onSave", function(e,id,fields_to_update){
        input.set(id,fields_to_update);
    });
    
    $("#table").bind("onResume", function(e){
        updaterStart(update, 10000);
    });

    $("#table").bind("onDelete", function(e,id,row){
        $('#myModal').modal('show');
        $('#myModal').attr('scheduleid',id);
        $('#myModal').attr('feedrow',row);
    });

    $("#confirmdelete").click(function()
    {
        var id = $('#myModal').attr('scheduleid');
        var row = $('#myModal').attr('schedulerow');
        input.remove(id);
        table.remove(row);
        update();

        $('#myModal').modal('hide');
    });
    
//------------------------------------------------------------------------------------------------------------------------------------
// Process list UI js
//------------------------------------------------------------------------------------------------------------------------------------
 
    $("#table").on('click', '.icon-wrench', function() {
        
        var i = table.data[$(this).attr('row')];
        console.log(i);
        processlist_ui.inputid = i.id;
        
        var processlist = [];
        if (i.processList!=null && i.processList!="")
        {
            var tmp = i.processList.split(",");
            for (n in tmp)
            {
                var process = tmp[n].split(":"); 
                processlist.push(process);
            }
        }
        
        processlist_ui.variableprocesslist = processlist;
        processlist_ui.draw();
        
        // SET INPUT NAME
        var inputname = "";
        if (processlist_ui.inputlist[processlist_ui.inputid].description!="") {
            inputname = processlist_ui.inputlist[processlist_ui.inputid].description;
            $("#feed-name").val(inputname);
        } else {
            inputname = processlist_ui.inputlist[processlist_ui.inputid].name;
            $("#feed-name").val("node:"+processlist_ui.inputlist[processlist_ui.inputid].nodeid+":"+inputname);
        }
        
        $("#inputname").html("Node"+processlist_ui.inputlist[processlist_ui.inputid].nodeid+": "+inputname);
        
        $("#feed-tag").val("Node:"+processlist_ui.inputlist[processlist_ui.inputid].nodeid);
        
        $("#processlist-ui #process-select").change();  // Force a refresh
        
        $("#processlist-ui").show();
        window.scrollTo(0,0);
        
    });

function load_all()
{
    for (z in table.data) assoc_inputs[table.data[z].id] = table.data[z];
    console.log(assoc_inputs);
    processlist_ui.inputlist = assoc_inputs;
    
    // Inputlist
    var out = "";
    for (i in processlist_ui.inputlist) {
      var input = processlist_ui.inputlist[i];
      out += "<option value="+input.id+">"+input.nodeid+":"+input.name+" "+input.description+"</option>";
    }
    $("#input-select").html(out);
    
    $.ajax({ url: path+"scheduler/list.json", dataType: 'json', async: true, success: function(result) {
        var schedulers = {};
        for (z in result) schedulers[result[z].id] = result[z];
        
        processlist_ui.schedulerlist = schedulers;
        var groupname = {0:'Public',1:'Mine'};
        var groups = [];
        //for (z in result) schedulers[result[z].id] = result[z];
        
        for (z in processlist_ui.schedulerlist)
        {
            var group = processlist_ui.schedulerlist[z].own;
            group = groupname[group];
            if (!groups[group]) groups[group] = []
            processlist_ui.schedulerlist[z]['_index'] = z;
            groups[group].push(processlist_ui.schedulerlist[z]);
        }
        
        var out = "";
        for (z in groups)
        {
            out += "<optgroup label='"+z+"'>";
            for (p in groups[z])
            {
                out += "<option value="+groups[z][p]['id']+">"+groups[z][p]['name']+(z!=groupname[1]?" ["+groups[z][p]['id']+"]":"")+"</option>";
            }
            out += "</optgroup>";
        }
        $("#schedule-select").html(out);
    }});
    
    $.ajax({ url: path+"feed/list.json", dataType: 'json', async: true, success: function(result) {
        var feeds = {};
        for (z in result) feeds[result[z].id] = result[z];
        
        processlist_ui.feedlist = feeds;
        // Feedlist
        var out = "<option value=-1>CREATE NEW:</option>";
        for (i in processlist_ui.feedlist) {
          out += "<option value="+processlist_ui.feedlist[i].id+">"+processlist_ui.feedlist[i].name+"</option>";
        }
        $("#feed-select").html(out);
    }});
    
    $.ajax({ url: path+"input/getallprocesses.json", async: true, dataType: 'json', success: function(result){
        processlist_ui.processlist = result;
        var processgroups = [];
        var i = 0;
        for (z in processlist_ui.processlist)
        {
            i++;
            var group = processlist_ui.processlist[z][5];
            if (group!="Deleted") {
                if (!processgroups[group]) processgroups[group] = []
                processlist_ui.processlist[z]['id'] = z;
                processgroups[group].push(processlist_ui.processlist[z]);
            }
        }

        var out = "";
        for (z in processgroups)
        {
            out += "<optgroup label='"+z+"'>";
            for (p in processgroups[z])
            {
                out += "<option value="+processgroups[z][p]['id']+">"+processgroups[z][p][0]+"</option>";
            }
            out += "</optgroup>";
        }
        $("#process-select").html(out);
        
        $("#description").html(process_info[1]);
        processlist_ui.showfeedoptions(1);
    }});
   
    processlist_ui.events();
}
</script>
