<!DOCTYPE html>
<html lang="">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Title Page</title>

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jQuery-QueryBuilder@2.5.2/dist/css/query-builder.default.min.css">
		
	</head>
	<body>
		<br />
		<div>
			 
			<label>From</label>
			<select name="from" id="from_col" style="width: 100px; height: 33px">
            	<option value="1">Pre-active</option>
            	<option value="2">Active</option>
            	<option value="3">Remove</option>
            </select>

            <label>To</label>
			<select name="to" id="to_col" style="width: 100px; height: 33px">
            	<option value="1">Pre-active</option>
            	<option value="2">Active</option>
            	<option value="3">Remove</option>
            </select>
        

		</div>
		<br />

		<div class="col-md-12">
		    <div id="builder-basic"></div>

		    <div class="btn-group">
		      <button class="btn btn-warning reset" id="btn-reset"  data-target="basic">Reset</button>
		      <button class="btn btn-success set-json" id="btn-set" data-target="basic">Set rules</button>
		      <button class="btn btn-primary parse-json" id="btn-get" data-target="basic">Get rules</button>
		    </div>
		  </div>
		
		<!-- jQuery -->
		<script src="//code.jquery.com/jquery.js"></script>
		<!-- Bootstrap JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/jquery-extendext@0.1.2/jQuery.extendext.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/dot/1.1.2/doT.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/jQuery-QueryBuilder@2.5.2/dist/js/query-builder.min.js"></script>
		<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
 		<script>
 			
 			var rules_basic = {
 			  condition: 'AND',
 			  rules: [{
 			    id: 'price',
 			    operator: 'less',
 			    value: 10.25
 			  }, {
 			    condition: 'OR',
 			    rules: [{
 			      id: 'category',
 			      operator: 'equal',
 			      value: 2
 			    }, {
 			      id: 'category',
 			      operator: 'equal',
 			      value: 1
 			    }]
 			  }]
 			};

 			$('#builder-basic').queryBuilder({
 			  plugins: ['bt-tooltip-errors'],
 			  
 			  filters: [{
 			    id: 'name',
 			    label: 'Name',
 			    type: 'string'
 			  }, {
 			    id: 'category',
 			    label: 'Category',
 			    type: 'integer',
 			    input: 'select',
 			    values: {
 			      1: 'Books',
 			      2: 'Movies',
 			      3: 'Music',
 			      4: 'Tools',
 			      5: 'Goodies',
 			      6: 'Clothes'
 			    },
 			    operators: ['equal', 'not_equal', 'in', 'not_in', 'is_null', 'is_not_null']
 			  }, {
 			    id: 'in_stock',
 			    label: 'In stock',
 			    type: 'integer',
 			    input: 'radio',
 			    values: {
 			      1: 'Yes',
 			      0: 'No'
 			    },
 			    operators: ['equal']
 			  }, {
 			    id: 'price',
 			    label: 'Price',
 			    type: 'double',
 			    validation: {
 			      min: 0,
 			      step: 0.01
 			    }
 			  }, {
 			    id: 'id',
 			    label: 'Identifier',
 			    type: 'string',
 			    placeholder: '____-____-____',
 			    operators: ['equal', 'not_equal'],
 			    validation: {
 			      format: /^.{4}-.{4}-.{4}$/
 			    }
 			  }],

 			  rules: rules_basic
 			});

 			$('#btn-reset').on('click', function() {
 			  $('#builder-basic').queryBuilder('reset');
 			});

 			$('#btn-set').on('click', function() {
 			  $('#builder-basic').queryBuilder('setRules', rules_basic);
 			});

 			$('#btn-get').on('click', function() {
 			  var result = $('#builder-basic').queryBuilder('getRules');
 			  
 			  if (!$.isEmptyObject(result)) {
 			    JSON.stringify(result, null, 2);
 			  }

 			  var from = $("#from_col").val();
 			  var to = $("#to_col").val();
//sending result to php file
				
 			   $.post("test.php",
                    {result: result, from: from, to: to }
                    ,function (response) {

                     if(response!=""){
                     	alert(response);
                     }

                 
                });
  //  

 			});
 		</script>



	</body>
</html>