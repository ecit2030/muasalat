<div class="mb-3 text-end">
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPageModal">
        + Add Page
    </button>
</div>

<div class="modal fade" id="addPageModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form action="route('dashboard.general.pages.store')" method="POST">
            @csrf

            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Add Page</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    {{-- Title AR --}}
                    <div class="mb-3">
                        <label class="form-label">Title (AR)</label>
                        <input type="text" name="title[ar]" class="form-control" required>
                    </div>

                    {{-- Title EN --}}
                    <div class="mb-3">
                        <label class="form-label">Title (EN)</label>
                        <input type="text" name="title[en]" class="form-control" required>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Cancel
                    </button>
                    <button type="submit" class="btn btn-primary">
                        Save
                    </button>
                </div>

            </div>
        </form>
    </div>
</div>

<x-pages.datatable :title="t_('Pages')" :create="false" route="dashboard.general.pages" :datatable="$dataTable" />
