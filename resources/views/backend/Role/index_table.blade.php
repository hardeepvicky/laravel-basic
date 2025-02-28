
<div class="card" id="page-summary">
    <div class="card-header">
        <x-backend.pagination-links :records="$records"/>
    </div>

    <div class="card-body p-1">
        <div class="m-2">
            <span class="btn btn-secondary">Export CSV</span>
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr class="border-bottom-primary">
                        <th><?= sortable_anchor('id', 'ID') ?></th>
                        <th><?= sortable_anchor('name', 'Name') ?></th>
                        <th><?= sortable_anchor('is_admin', 'Admin') ?></th>
                        <th><?= sortable_anchor('is_active', 'Active / De-Active') ?></th>
                        <th><?= sortable_anchor('is_pre_defined', 'Pre-Defined') ?></th>
                        <th>Info</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($records as $record)
                    <tr>
                        <th scope="row">{{ $record->id }}</th>
                        <td>{{ $record->name }}</td>
                        <td>
                            <x-backend.yes-no-label :value="$record->is_admin"/>
                        </td>
                        <td>
                            <x-backend.active_deactive :isActive="$record->is_active" :id="$record->id" :routePrefix="$routePrefix"/>
                        </td>
                        <td>
                            <x-backend.yes-no-label :value="$record->is_pre_defined"/>
                        </td>
                        <td>
                            <x-backend.index-table-info :record="$record" :userList="$userListCache" />
                        </td>
                        <td>
                            <x-backend.summary-comman-actions :id="$record->id" :routePrefix="$routePrefix"/>                            
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer">
        <x-backend.pagination-links :records="$records"/>
    </div>
</div>