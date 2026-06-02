@extends('layouts/contentNavbarLayout')

@section('title', trns($route))

@section('content')
<h4 class="py-3 mb-4">
    <span class="text-muted fw-light">
        <a href="{{ route('dashboard-analytics') }}">{{ trns('Dashboard') }}</a> /
    </span> {{ trns($route) }}
</h4>


<style>
    /* Table specific overrides */
    #usersTable tbody tr {
        cursor: grab;
    }
    #usersTable tbody tr:active {
        cursor: grabbing;
    }
</style>

<hr class="my-4" />

<!-- Card -->
<div class="card shadow-lg border-0">
  <h5 class="card-header d-flex justify-content-between align-items-center flex-wrap gap-3">
    <div class="d-flex align-items-center gap-3">
      <span class="fs-4 fw-bold text-white"><i class="fas fa-project-diagram text-primary me-2"></i>{{ trns($route) }}</span>
      <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center d-none d-sm-flex">
        <li class="avatar avatar-xs pull-up me-1">
          <img src="{{ asset('assets/img/avatars/5.png') }}" class="rounded-circle" style="width:28px; height:28px;">
        </li>
        <li class="avatar avatar-xs pull-up me-1">
          <img src="{{ asset('assets/img/avatars/6.png') }}" class="rounded-circle" style="width:28px; height:28px;">
        </li>
        <li class="avatar avatar-xs pull-up me-1">
          <img src="{{ asset('assets/img/avatars/7.png') }}" class="rounded-circle" style="width:28px; height:28px;">
        </li>
      </ul>
    </div>
    <div class="d-flex gap-2 align-items-center flex-wrap">
      <button class="btn btn-success d-flex align-items-center gap-2" id="bulkStatusUpdate">
        <i class="fas fa-check-double"></i> {{trns("Update_Selected")}}
      </button>
      <button class="btn btn-danger d-flex align-items-center gap-2" id="deleteSelected">
        <i class="fas fa-trash-alt"></i> {{ trns("Delete_Selected") }}
      </button>
      <a href="{{ route($route . '.create') }}" class="btn btn-primary d-flex align-items-center gap-2">
        <i class="fas fa-plus"></i> {{ trns('Add_New') }} {{ $route }}
      </a>
    </div>
  </h5>
   <!-- Delete Selected Modal -->
    <div class="modal fade" id="deleteConfirmModal" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title d-flex align-items-center gap-2 text-danger">
                      <i class="fas fa-exclamation-triangle"></i> {{ trns('confirm_deletion') }}
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body py-4">
                    <p class="mb-0 fs-5 text-white-50">{{ trns('are_you_sure_you_want_to_delete_selected_items') }}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">{{ trns('cancel') }}</button>
                    <button type="button" class="btn btn-danger" id="confirm-delete-btn">{{ trns('delete') }}</button>
                </div>
            </div>
        </div>
    </div>

  <div class="card-body">
    <div class="table-responsive text-nowrap">
      <table class="table" id="usersTable">
        <thead>
          <tr>
            <th style="width: 40px;"></th>
            <th><input type="checkbox" id="select-all"></th>
            <th>{{ trns('title') }}</th>
            <th>{{ trns('description') }}</th>
            <th>{{ trns('url') }}</th>
            <th>{{ trns('image') }}</th>
            <th>{{ trns('category') }}</th>
            <th>{{ trns('sort_order') }}</th>
            <th>{{ trns('partner_id') }}</th>
            <th>{{ trns('Actions') }}</th>
          </tr>
        </thead>
        <tbody></tbody>
      </table>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<!-- jQuery UI Sortable for Drag and Drop -->
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>

<script>
$(document).ready(function () {
    const table = $('#usersTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route($route . ".index") }}',
        columns: [
            {
                data: null,
                orderable: false,
                searchable: false,
                className: 'drag-handle-cell text-center',
                render: function() {
                    return `<span class="drag-handle"><i class="fas fa-grip-vertical"></i></span>`;
                }
            },
            {
                data: 'id',
                orderable: false,
                searchable: false,
                render: function(data) {
                    return `<input type="checkbox" class="row-checkbox" value="${data}">`;
                }
            },
            { data: 'title', name: 'title' },
            { data: 'description', name: 'description' },
            { data: 'url', name: 'url' },
            { data: 'image', name: 'image' },
            { data: 'category', name: 'category' },
            { 
                data: 'sort_order', 
                name: 'sort_order',
                render: function(data, type, row) {
                    return `<input type="number" 
                                   class="form-control text-center sort-order-input" 
                                   value="${data}" 
                                   data-id="${row.id}" 
                                   style="width: 80px; margin: 0 auto; background: rgba(255,255,255,0.04); border: 1.5px solid rgba(255,255,255,0.1); color: #fff; border-radius: 8px; padding: 4px 8px; font-weight: 600; transition: all 0.25s ease-in-out;">`;
                }
            },
            { data: 'partner_id', name: 'partner_id' },
            { data: 'action', name: 'action', orderable: false, searchable: false }
        ],

        order: [[7, "asc"]],
        language: {
            sZeroRecords: "No records found",
            sProcessing: "Processing...",
            sSearch: "Search:",
            oPaginate: {
                sPrevious: "Previous",
                sNext: "Next"
            }
        }
    });

    // Initialize drag-and-drop sortable
    $('#usersTable tbody').sortable({
        axis: 'y',
        handle: '.drag-handle', // Drag action triggered only from grip handle
        opacity: 0.85,
        cancel: 'input,textarea,button,select,option,a,.row-checkbox,.btn',
        helper: function(e, tr) {
            var $originals = tr.children();
            var $helper = tr.clone();
            $helper.children().each(function(index) {
                $(this).width($originals.eq(index).width());
            });
            return $helper;
        },
        update: function (event, ui) {
            // 1. Recalculate SORT ORDER values in the UI instantly after drop
            $('#usersTable tbody tr').each(function (index) {
                const newOrder = index + 1;
                const $cell = $(this).find('td').eq(7); // index 7 is sort_order now
                
                // Apply value and pulse animation to highlight change
                $cell.text(newOrder);
                $cell.removeClass('order-updated-pulse');
                void $cell[0].offsetWidth; // trigger reflow
                $cell.addClass('order-updated-pulse');
            });

            // 2. Get list of sorted IDs
            const ids = [];
            $('#usersTable tbody .row-checkbox').each(function () {
                ids.push($(this).val());
            });

            if (ids.length === 0) return;

            // 3. Send AJAX request to update the database asynchronously
            $.ajax({
                type: 'POST',
                url: '{{ route($route . ".updateOrder") }}',
                data: {
                    _token: '{{ csrf_token() }}',
                    ids: ids
                },
                success: function (response) {
                    if (response.status === 200) {
                        toastr.success("{{ trns('Updated Successfully') }}");
                        // 4. Reload DataTables in the background to ensure data state integrity without disrupting view
                        table.ajax.reload(null, false);
                    } else {
                        toastr.error("{{ trns('something_went_wrong') }}");
                    }
                },
                error: function () {
                    toastr.error("{{ trns('something_went_wrong') }}");
                }
            });
        }
    });

    // Cache original value on focus to prevent redundant requests
    let originalSortOrder = null;
    $('#usersTable tbody').on('focus', '.sort-order-input', function () {
        originalSortOrder = $(this).val();
    });

    // Handle inline SORT ORDER input updates immediately on blur (unfocus)
    $('#usersTable tbody').on('blur', '.sort-order-input', function () {
        const id = $(this).attr('data-id');
        const sortOrder = $(this).val();
        const $input = $(this);

        // If the value has not changed, don't send a request
        if (originalSortOrder !== null && originalSortOrder === sortOrder) {
            return;
        }

        console.log("Inline sort order update triggered on blur (unfocus):", { id: id, sort_order: sortOrder });

        if (!id || sortOrder === '') {
            console.warn("Update aborted: Missing ID or sort order value.", { id: id, sortOrder: sortOrder });
            return;
        }

        // Visual loading feedback (glow border color transitions)
        $input.css('border-color', '#ffc107'); // yellow during update

        $.ajax({
            type: 'POST',
            url: '{{ route($route . ".updateOrder") }}',
            data: {
                _token: '{{ csrf_token() }}',
                id: id,
                sort_order: sortOrder
            },
            success: function (response) {
                if (response.status === 200) {
                    toastr.success("{{ trns('Updated Successfully') }}");
                    $input.css('border-color', '#10b981'); // green for success
                    setTimeout(function() {
                        $input.css('border-color', 'rgba(255,255,255,0.1)'); // restore original
                    }, 1500);
                    // Reload DataTables in the background to ensure data state integrity
                    table.ajax.reload(null, false);
                } else {
                    toastr.error("{{ trns('something_went_wrong') }}");
                    $input.css('border-color', '#ef4444'); // red for error
                }
            },
            error: function () {
                toastr.error("{{ trns('something_went_wrong') }}");
                $input.css('border-color', '#ef4444');
            }
        });
    });

    $('#select-all').on('click', function () {
        const rows = table.rows({ search: 'applied' }).nodes();
        $('input[type="checkbox"].row-checkbox', rows).prop('checked', this.checked);
    });

    $('#usersTable tbody').on('change', 'input.row-checkbox', function () {
        if (!this.checked) {
            $('#select-all').prop('checked', false);
        }
    });

    $('#bulkStatusUpdate').on('click', function () {
        const selectedIds = [];
        $('input.row-checkbox:checked').each(function () {
            selectedIds.push($(this).val());
        });

        if (selectedIds.length === 0) {
            alert('{{ trns("Please select at least one user.") }}');
            return;
        }

        $.ajax({
            type: 'POST',
            url: '{{ route($route . ".updateColumnSelected") }}',
            data: {
                _token: '{{ csrf_token() }}',
                ids: selectedIds,
                status: 'Active' 
            },
            success: function (data) {
                if (data.status === 200) {
                    toastr.success("Updated Successfully");
                    table.ajax.reload();
                } else {
                    toastr.error("Something went wrong");
                }
            },
            error: function () {
                toastr.error("AJAX Error");
            }
        });
    });


         // Bulk Delete
      $('#deleteSelected').on('click', function () {
          const selected = $('.row-checkbox:checked').map(function() {
              return $(this).val();
          }).get();

          if(selected.length === 0){
              alert('{{ trns("Please select at least one user.") }}');
              return;
          }

          let deleteModal = new bootstrap.Modal(document.getElementById('deleteConfirmModal'));
          deleteModal.show();

          $('#confirm-delete-btn').off('click').on('click', function() {
              $.ajax({
                  url: '{{ route($route . ".destroySelected") }}',
                  type: 'POST',
                  data: {
                      _token: '{{ csrf_token() }}',
                      ids: selected
                  },
                  success: function(response) {
                      if(response.status === 200){
                          toastr.success('{{ trns("deleted_successfully") }}');
                          deleteModal.hide();
                          $('#select-all').prop('checked', false);
                          $('.row-checkbox').prop('checked', false);
                          table.ajax.reload();
                      } else {
                          toastr.error('{{ trns("something_went_wrong") }}');
                      }
                  },
                  error: function() {
                      toastr.error('{{ trns("something_went_wrong") }}');
                      deleteModal.hide();
                  }
              });
          });
      });



});

    // Delete Record
    $(document).on('click', '.delete-confirm', function() {
        var url = $(this).data('url'); 
        if(confirm('{{ trns("Are_you_sure?") }}')) {
            $.ajax({
                url: url,
                type: 'DELETE',
                data: {
                    "_token": "{{ csrf_token() }}"
                },
                success: function(response) {
                    if (response.status) {
                        toastr.success('{{ trns("Deleted_Successfully") }}');
                        table.ajax.reload();
                    } else {
                        toastr.error('{{ trns("Something_went_wrong") }}');
                    }
                },
                error: function(xhr) {
                    toastr.error('{{ trns("Something_went_wrong") }}');
                }
            });
        }
    });
</script>


<script>
        // for status
        $(document).on('click', '.statusBtn', function() {
            let id = $(this).data('id');

            var val = $(this).is(':checked') ? 1 : 0;

            let ids = [id];
            $.ajax({
                type: 'POST',
                url: '{{ route($route . ".updateColumnSelected") }}',
                data: {
                    "_token": "{{ csrf_token() }}",
                    'ids': ids,
                },
                success: function(data) {
                    if (data.status === 200) {
                        if (val !== 0) {
                            toastr.success('Success', "");
                            $("#usersTable").DataTable().ajax.reload();
                        } else {
                            toastr.warning('Success', "");
                        }
                    } else {
                        toastr.error('Error', "");
                    }
                },
                error: function() {
                    toastr.error('Error', "{{ trns('something_went_wrong') }}");
                }
            });
        });

        $(document).on("change", "#statusSelection", function() {
            let status = $(this).val();
            let table = $('#usersTable').DataTable();

            table.rows().every(function() {
                var row = this.node();
                var checkbox = $(row).find('.statusBtn');
                var shouldShow = false;

                if (status === 'show all') shouldShow = true;
                else if (status === 'active') shouldShow = checkbox.is(':checked');
                else if (status === 'inactive') shouldShow = !checkbox.is(':checked');

                $(row).toggle(shouldShow);
            });
        });
    </script>



@endpush