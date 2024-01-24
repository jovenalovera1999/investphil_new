@extends('layout.main')

@section('content')

@include('include.topbar')

<style>
    td {
        vertical-align: middle !important;
    }

    td p {
        margin: flex;
        padding: flex;
        line-height: 2em;
    }
</style>

<div class="container">
    <div class="row">
        <div class="col-sm-2">
            @include('include.navbar')
        </div>
        <div class="col-sm-4">
            <form action="#" method="post" class="mt-5">
                <div class="ms-1 me-1">
                    <form action="/clients" method="get">
                        <label for="search">Search</label>
                        <input type="text" class="form-control" id="search" name="search" />
                        <button class="btn btn-primary mt-2 mb-3">Search</button>
                    </form>
                </div>
                <div class="card">
                    <div class="card-header">
                        House Form
                    </div>
                    <div class="card-body">
                        <div class="form-group" id="msg"></div>
                        <input type="hidden" name="id">
                        <div class="form-group">
                            <label class="control-label">House No</label>
                            <input type="text" class="form-control" name="house_no" required="">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Category</label>
                            <select name="category_id" id="" class="custom-select" required>
                                <option selected>Please check the category list.</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label">Description</label>
                            <textarea name="description" id="" cols="30" rows="4" class="form-control" required></textarea>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Price</label>
                            <input type="number" class="form-control text-right" name="price" step="any" required="">
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-sm btn-primary col-sm-3 offset-md-3" name="add_house">
                                    Save</button>
                                <button class="btn btn-sm btn-default col-sm-3" type="reset"> Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-sm-5">
            <table class="table table-bordered table-hover mt-5">
                <div class="float-end mt-3">
                    {{ $houses->links() }}
                </div>
                <thead>
                    <tr>
                        <th class="text-center">House</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($houses as $house)    
                    <tr>
                        <td>
                            House No:
                            <?=$house->house_no?>
                            <br><br>
                            House Type:
                            <?=$house->category?>
                            <br><br>
                            Description:
                            <?=$house->description?>
                            <br><br>
                            Price:
                            <?=$house->price?>
                        </td>
                        <td>
                            <div class="btn-group" role="" group>
                                <a href="#" class="btn btn-outline-warning">Edit</a>
                                <a href="#" class="btn btn-outline-danger">Delete</a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- <script>
    $('#manage-house').on('reset',function(e){
		$('#msg').html('')
	})
	$('#manage-house').submit(function(e){
		e.preventDefault()
		start_load()
		$('#msg').html('')
		$.ajax({
			url:'ajax.php?action=save_house',
			data: new FormData($(this)[0]),
		    cache: false,
		    contentType: false,
		    processData: false,
		    method: 'POST',
		    type: 'POST',
			success:function(resp){
				if(resp==1){
					alert_toast("Data successfully saved",'success')
					setTimeout(function(){
						location.reload()
					},1500)

				}
				else if(resp==2){
					$('#msg').html('<div class="alert alert-danger">House number already exist.</div>')
					end_load()
				}
			}
		})
	})
	$('.edit_house').click(function(){
		start_load()
		var cat = $('#manage-house')
		cat.get(0).reset()
		cat.find("[name='id']").val($(this).attr('data-id'))
		cat.find("[name='house_no']").val($(this).attr('data-house_no'))
		cat.find("[name='description']").val($(this).attr('data-description'))
		cat.find("[name='price']").val($(this).attr('data-price'))
		cat.find("[name='category_id']").val($(this).attr('data-category_id'))
		end_load()
	})

	$('.delete_house').click(function(){
		_conf("Are you sure to delete this house?","delete_house",[$(this).attr('data-id')])
	})
	function delete_house($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_house',
			method:'POST',
			data:{id:$id},
			success:function(resp){
				if(resp==1){
					alert_toast("Data successfully deleted",'success')
					setTimeout(function(){
						location.reload()
					},1500)

				}
			}
		})
	}
	$('table').dataTable()
</script> --}}

@endsection