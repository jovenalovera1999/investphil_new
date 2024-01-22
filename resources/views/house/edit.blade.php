@extends('layout.main')

@section('content')

@include('include.topbar')

<div class="container">
    <div class="row">
        
        <div class="col-sm-2">
            @include('include.navbar')
        </div>
        <div class="col-sm-10">
            <form action="#" method="post" class="mt-5">
                <div class="card">
                    <div class="card-header">
                        House Form
                    </div>
                    <div class="card-body">
                        <div class="form-group" id="msg"></div>
                        <input type="hidden" name="id">
                        <div class="form-group">
                            <label class="control-label">House No</label>
                            <input type="text" class="form-control" name="house_no" value="" required>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Category</label>
                            <select name="category_id" id="" class="custom-select" required>
                                <option value="" selected hidden>
                                    
                                </option>
                                {{-- <?php foreach($categories as $category): ?>
                                <option value="<?=$category->category_id;?>">
                                    <?=$category->category;?>
                                </option>
                                <?php endforeach; ?> --}}
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label">Description</label>
                            <textarea name="description" id="" cols="30" rows="4" class="form-control"
                                required></textarea>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Price</label>
                            <input type="number" class="form-control text-right" name="price" value="" step="any"
                                required="">
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-sm btn-primary col-sm-3 offset-md-3" name="edit_house">
                                    Save</button>
                                <button class="btn btn-sm btn-default col-sm-3" type="reset"> Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection