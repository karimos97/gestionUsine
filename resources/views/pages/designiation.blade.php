{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')
<link href="{{asset('plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />

<div class="d-flex flex-column-fluid">
							<!--begin::Container-->
							<div class="container">

								<!--begin::Card-->
								<div class="card card-custom">
									<div class="card-header">
										<div class="card-title">
											<span class="card-icon">
												<i class="flaticon2-supermarket text-primary"></i>
											</span>
											<h3 class="card-label">Designiation List</h3>
										</div>
										<div class="card-toolbar">

											<!--begin::Button-->
											<a href="#"  id="add_design" class="btn btn-primary font-weight-bolder">
											<span class="svg-icon svg-icon-md">
												<!--begin::Svg Icon | path:assets/media/svg/icons/Design/Flatten.svg-->
												<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
													<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
														<rect x="0" y="0" width="24" height="24" />
														<circle fill="#000000" cx="9" cy="15" r="6" />
														<path d="M8.8012943,7.00241953 C9.83837775,5.20768121 11.7781543,4 14,4 C17.3137085,4 20,6.6862915 20,10 C20,12.2218457 18.7923188,14.1616223 16.9975805,15.1987057 C16.9991904,15.1326658 17,15.0664274 17,15 C17,10.581722 13.418278,7 9,7 C8.93357256,7 8.86733422,7.00080962 8.8012943,7.00241953 Z" fill="#000000" opacity="0.3" />
													</g>
												</svg>
												<!--end::Svg Icon-->
											</span>New Record</a>
											<!--end::Button-->
										</div>
									</div>
									<div class="card-body">
										<!--begin: Datatable-->
										<table class="table table-bordered table-hover table-checkable" id="m_table_1" style="margin-top: 13px !important">

										</table>
										<!--end: Datatable-->
									</div>
								</div>
								<!--end::Card-->
							</div>
							<!--end::Container-->
						</div>


                        <div class="modal fade" id="designiation" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Add Designiation</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <i aria-hidden="true" class="ki ki-close"></i>
                                        </button>
                                    </div>
                                    <input type="hidden" name="" id="type_switch">
                                    <div class="modal-body">
                                        <form class="form" id="designition_form">
                                            @csrf
                                            <input type="hidden" name="id">
                                            <div class="card-body">
                                             <div class="form-group row">
                                              <div class="col-lg-6">
                                               <label>Nom:</label>
                                               <input type="text" name="nom" class="form-control" placeholder="Enter  name"/>
                                               <span class="form-text text-muted">Please enter the name</span>
                                              </div>
                                              <div class="col-lg-6">
                                               <label>image</label>
                                               <input type="file"  accept="image/*"  name="path"  class="form-control" placeholder="Enter contact number"/>
                                               <span class="form-text text-muted">Please upload your Iamge File</span>
                                              </div>
                                             </div>
                                             <div class="form-group row">
                                              <div class="col-lg-6">
                                               <label>Prix G:</label>
                                               <div class="input-group">
                                                <input type="number" name="price_g" class="form-control" placeholder="Enter your price"/>
                                               </div>
                                               <span class="form-text text-muted">Please enter your price</span>
                                              </div>
                                              <div class="col-lg-6">
                                               <label>Prix P:</label>
                                               <div class="input-group">
                                                <input type="number" name="price_p" class="form-control" placeholder="Enter your price"/>
                                               </div>
                                               <span class="form-text text-muted">Please enter your Price</span>
                                              </div>
                                             </div>
                                             <div class="form-group row">
                                                <div class="col-lg-6">
                                                 <label>Prix Std:</label>
                                                 <div class="input-group">
                                                  <input type="number" name="price_std" class="form-control" placeholder="Enter your price"/>
                                                 </div>
                                                 <span class="form-text text-muted">Please enter your price</span>
                                                </div>
                                               </div>
                                            </div>
                                           </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
                                        <button type="button" id="desig_submit" class="btn btn-primary font-weight-bold">Save changes</button>
                                    </div>
                                </div>
                            </div>
                        </div>

 @endsection

{{-- Scripts Section --}}
@section('scripts')
<script src="{{ asset('plugins/custom/datatables/datatables.bundle.js') }}"></script>

<script>

    $('#add_design').click(function(){
        $('#designition_form')[0].reset()
        $('.modal-title').text('Add Designiation')
        $('#type_switch').val(0)
        $('#designiation').modal('show')
    })
    $('#desig_submit').click(function(){
        form=new FormData($('#designition_form')[0])

        switcher=$('#type_switch').val()
        url1="{{ route('designition.add') }}"
        url2="{{ route('designation.update') }}"
        if (parseInt(switcher)===1) {
            url=url2
        } else {
            url=url1
        }
        $.ajax({
            type: "post",
            url: url,
            data: form,
            dataType: "json",
            processData: false,
            contentType: false,
            success: function (response) {
                t.draw()
                $('#designiation').modal('hide')
                toastr.success(response.message)
            }
        });
    })



    var t;
var table2
var DatatablesDataSourceAjaxServer = {
    init: function() {
        var myData = {};
        t = $("#m_table_1").DataTable({
            dom: 'frtlip',
            searchDelay: 500,
            processing: true,
            serverSide: true,
            order: [
                [1, 'desc']
            ],
            lengthMenu: [
                [20, 100, 500, -1],
                [20, 100, 500, "ALL"]
            ],
            select: {
                style: "multi",
                selector: "td:first-child .m-checkable"
            },
            headerCallback: function(e, a, t, n, s) {
                e.getElementsByTagName("th")[0].innerHTML =
                    '<label class="m-checkbox m-checkbox--single m-checkbox--solid m-checkbox--brand"><input type="checkbox" value="" class="m-group-checkable"><span></span></label>'
            },
            ajax: {
                url: "{{ route('designation.show') }}",
                method: 'POST',
                data: function(d) {
                    d.startdate = myData.startdate;
                    d.enddate = myData.enddate;
                    d.bk=$('#bank_filter').val()
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            },
            footerCallback: function ( row, data, start, end, display ) {
            var api = this.api(), data;
            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };

            // Total over all pages
            total = api
                .column( 4 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

            // Total over this page
            pageTotal = api
                .column( 4, { page: 'current'} )
                .data()
                .reduce( function (a, b) {

                    return intVal(a) + intVal(b);
                }, 0 );

            // Update footer
            $( api.column( 4 ).footer() ).html(
                 formatMoney(total)
            );
        },
            columns: [{
                    targets: 0,

                    orderable: !1,
                    render: function(a, b, c, d) {
                        return '<label class="m-checkbox m-checkbox--single m-checkbox--solid m-checkbox--brand"><input type="checkbox" value="' +
                            c.id + '" class="m-checkable"><span></span></label>'
                    }
                },{
                    field: "id",
                    title: "{{ __('#Id') }}",
                    data: "banks.id",
                    filterable: !0,
                    width:30 ,
                    class: "text-right font-weight-bold",
                    sortable: !0,
                    render: function(a, b, c, d) {
                        return '<button type="button" class="btn btn-outline-info btn-sm" onclick="getBankInfo('+c.id+')">#' +  c.id  + '</button>'
                    }
                }, {
                    field: "iamge",
                    title: "{{ __('Image') }}",
                    filterable: !0,
                    width: 200,
                    class: "text-center",
                    sortable: !0,
                    render: function(a, b, c, d) {
                        path=''
                        try {
                            path=c.photo.replace('public', 'storage')
                        } catch (error) {

                        }
                        return  '<img  style="    width: 216px;height: 100px;" src="'+path+'">'
                    }
                },
                {
                    field: "name",
                    data:"nom",
                    title: "{{ __('Name') }}",
                    filterable: !0,
                    width: 50,
                    class: "text-center",
                    sortable: !0,
                    render: function(a, b, c, d) {
                            return c.nom
                    }
                },

                 {
                    field: "prix_g",
                    data: "prix_g",
                    title: '{{ __("Prix G") }}',
                    filterable: !0,
                    sortable: !0,
                    width: 50,
                    class: "font-weight-bold",
                    render: function(a, b, c, d) {
                        return formatMoney(c.prix_g)+' <small>EUR</small>'
                    }
                }, {
                    field: "prix_g",
                    data: "prix_g",
                    title: "{{ __('Prix P') }}",
                    filterable: !0,
                    width: 90,
                    sortable: !0,
                    render: function(a, b, c, d) {
                        return formatMoney(c.prix_p)+' <small>EUR</small>'

                    }
                }, {
                    field: "prix_std",
                    data: "prix_std",
                    title: "{{ __('Prix Std') }}",
                    filterable: !0,
                    width: 90,
                    sortable: !0,
                    render: function(a, b, c, d) {
                        return formatMoney(c.prix_std)+' <small>EUR</small>'

                    }
                },  {
                    field: "edit",
                    title: "",
                    width: 40,
                    textAlign: 'center',
                    sortable: false,
                    filterable: false,
                    searchable: false,
                    render: function(a, b, c, d) {
                          return '<a href="javascript:edit('+c.id+');" class="btn btn-sm btn-clean btn-icon" title="Edit details"><i class="la la-edit"></i></a><a href="javascript:remove('+c.id+');" class="btn btn-sm btn-clean btn-icon" title="Delete"><i class="la la-trash"></i>	</a>'
                    }
                }
            ],

        })



        t.on("change", ".m-group-checkable", function() {
            var a = $(this).closest("table").find("td:first-child .m-checkable"),
                z = $(this).is(":checked");
            $(a).each(function() {
                z ? ($(this).prop("checked", !0), t.rows($(this).closest("tr")).select()) :
                    ($(this).prop("checked", !1), t.rows($(this).closest("tr")).deselect())
            })
        })

        t.on("change", ".m-checkbox--single", function(e) {
            var a = $('td:first-child .m-checkable:checked').length;
            $("#m_datatable_selected_number").html(a), a > 0 ? $(".colap-item")
                .collapse("show") : $(".colap-item").collapse("hide")
        })




    }};


    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
jQuery(document).ready(function() {
    DatatablesDataSourceAjaxServer.init()


});


</script>

<script>

function remove(id){
    $.ajax({
        type: "post",
        url: "{{ route('designation.delete') }}",
        data: {id:id},
        dataType: "json",
        success: function (response) {
            t.draw()
        }
    });
}

function edit(id){
    $.ajax({
        type: "post",
        url: "{{ route('designation.get') }}",
        data: {id:id},
        dataType: "json",
        success: function (response) {
            $('#type_switch').val(1)
            $('input[name=nom]').val(response.nom);
            $('input[name=price_g]').val(response.prix_g);
            $('input[name=price_p]').val(response.prix_p);
            $('input[name=price_std]').val(response.prix_std);
            $('input[name=id]').val(response.id);

            $('.modal-title').text('Edit Designiation')
            $('#designiation').modal('show')

        }
    });
}
</script>
@endsection
