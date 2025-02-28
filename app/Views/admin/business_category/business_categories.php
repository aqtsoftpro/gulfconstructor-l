<div class="box">
    <div class="box-header with-border">
        <div class="left">
            <h3 class="box-title"><?= trans('business_categories'); ?></h3>
        </div>
        <div class="right">
            <a href="<?= adminUrl('add-business-category'); ?>" class="btn btn-success btn-add-new">
                <i class="fa fa-plus"></i>&nbsp;&nbsp;<?= trans('add_business_category'); ?>
            </a>
        </div>
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-sm-12">
                <form action="<?= adminUrl('business-categories'); ?>" method="get">
                    <div class="item-table-filter" style="width: 220px;">
                        <label><?= trans("search"); ?></label>
                        <input name="q" class="form-control" placeholder="<?= trans("search") ?>" type="search" value="<?= esc(inputGet('q', true)); ?>">
                    </div>
                    <div class="item-table-filter md-top-10" style="width: 65px; min-width: 65px;">
                        <label style="display: block">&nbsp;</label>
                        <button type="submit" class="btn bg-purple" style="height: 36px;"><?= trans("filter"); ?></button>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <?php 
            if (!empty(cleanStr(inputGet('q')))): ?>
                <div class="col-sm-12">
                    <div class="categories-panel-group nested-sortable">
                        <?php
                        if (!empty($searchBusinessCategories)):
                            foreach ($searchBusinessCategories as $sCategory): ?>
                                <div class="panel-group" draggable="false" style="cursor: default">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <div class="left">
                                                <?= esc($sCategory->name); ?> <span class="id">( <?= trans("id") . ': ' . $sCategory->id; ?>)</span></div>
                                            <div class="right">
                                                <div class="btn-group">
                                                    <a href="<?= adminUrl('edit-business-category/' . $sCategory->id); ?>" target="_blank" class="btn btn-sm btn-default btn-edit"><?= trans("edit"); ?></a>
                                                    <a href="javascript:void(0)" class="btn btn-sm btn-default btn-delete" data-item-id="<?= $sCategory->id; ?>"><i class="fa fa-trash-o"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach;
                        endif; ?>

                        <?php if (empty($searchBusinessCategories)): ?>
                            <p class="text-center"><?= trans("no_records_found"); ?></p>
                        <?php endif; ?>

                        <?php if (!empty($pager)): ?>
                            <div class="row">
                                <div class="col-sm-12 text-center">
                                    <?= $pager->links; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <?php else: ?>
                <div class="col-sm-12">
                    <div class="categories-panel-group nested-sortable">
                        <?= view('admin/business_category/_business_categories_print', ['categories' => $parentCategories]); ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-8 col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><?= trans('settings'); ?></h3>
            </div>
            <form action="<?= base_url('BusinessCategory/categorySettingsPost'); ?>" method="post">
                <?= csrf_field(); ?>
                <div class="box-body">
                    <div class="form-group">
                        <label><?= trans("sort_categories"); ?></label>
                        <div class="row">
                            <div class="col-md-3 col-sm-12">
                                <div class="custom-control custom-radio">
                                    <input type="radio" name="sort_categories" value="category_order" id="sort_categories_1" class="custom-control-input" <?= $generalSettings->sort_categories == 'category_order' ? 'checked' : ''; ?>>
                                    <label for="sort_categories_1" class="custom-control-label"><?= trans("by_category_order"); ?></label>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <div class="custom-control custom-radio">
                                    <input type="radio" name="sort_categories" value="date" id="sort_categories_2" class="custom-control-input" <?= $generalSettings->sort_categories == 'date' ? 'checked' : ''; ?>>
                                    <label for="sort_categories_2" class="custom-control-label"><?= trans("by_date"); ?></label>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <div class="custom-control custom-radio">
                                    <input type="radio" name="sort_categories" value="date_desc" id="sort_categories_3" class="custom-control-input" <?= $generalSettings->sort_categories == 'date_desc' ? 'checked' : ''; ?>>
                                    <label for="sort_categories_3" class="custom-control-label"><?= trans("by_date"); ?>&nbsp;(DESC)</label>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <div class="custom-control custom-radio">
                                    <input type="radio" name="sort_categories" value="alphabetically" id="sort_categories_4" class="custom-control-input" <?= $generalSettings->sort_categories == 'alphabetically' ? 'checked' : ''; ?>>
                                    <label for="sort_categories_4" class="custom-control-label"><?= trans("alphabetically"); ?></label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary pull-right"><?= trans('save_changes'); ?></button>
                </div>
            </form>
        </div>
        <div class="alert alert-info alert-large">
            <strong><?= trans("warning"); ?>!</strong>&nbsp;&nbsp;<?= trans("warning_category_sort"); ?>
        </div>
    </div>
</div>
<script>
    $(document).on("click", ".panel .panel-heading", function (e) {
        if ($(e.target).is('div') || $(e.target).is('span') || $(e.target).is('.fa-caret-right') || $(e.target).is('.fa-caret-down')) {
            var id = $(this).attr('data-item-id');
            $('#collapse_' + id).collapse("toggle");
            $('.left .fa', this).toggleClass('fa-caret-right').toggleClass('fa-caret-down');
        }
    });
    $(document).on("click", ".panel .panel-heading .btn-delete", function (e) {
        var id = $(this).attr('data-item-id');
        deleteItem("BusinessCategory/deleteCategoryPost", id, "<?= trans("confirm_delete", true);?>");
    });

    $(document).on('click', '.panel-heading-parent', function (e) {
        var id = $(this).attr('data-item-id');
        if ($(e.target).hasClass('btn')) {
            return true;
        }
        if ($('#panel_heading_parent_' + id).hasClass('parent-panel-open')) {
            return false;
        }
        $('#collapse_' + id + ' .spinner').css('visibility', 'visible');
        var data = {
            'id': id,
            'lang_id': <?= clrNum($lang); ?>
        };
        $.ajax({
            url: MdsConfig.baseURL + '/BusinessCategory/loadCategories',
            type: 'POST',
            data: setAjaxData(data),
            success: function (response) {
                var obj = JSON.parse(response);
                if (obj.result == 1) {
                    setTimeout(function () {
                        $('#panel_heading_parent_' + id).addClass('parent-panel-open');
                        document.getElementById('collapse_' + id).innerHTML = obj.htmlContent;
                    }, 50);
                }
            }
        });
    });
</script>

<style>
    .btn-group-option {
        display: inline-block !important;
    }

    .spinner {
        visibility: hidden;
    }

    .spinner > div {
        width: 16px;
        height: 16px;
        background-color: #999;
    }

    .cursor-default {
        cursor: default !important;
    }
</style>
