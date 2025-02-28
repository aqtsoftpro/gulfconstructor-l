<div class="row">
    <div class="col-lg-8 col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="left">
                    <h3 class="box-title"><?= trans('add_business_category'); ?></h3>
                </div>
                <div class="right">
                    <a href="<?= adminUrl('business-categories'); ?>" class="btn btn-success btn-add-new">
                        <i class="fa fa-list-ul"></i>&nbsp;&nbsp;<?= trans('business_categories'); ?>
                    </a>
                </div>
            </div>
            <form action="<?= base_url('BusinessCategory/addBusinessCategoryPost'); ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <input type="hidden" name="parent_id" value="0">
                <div class="box-body">
                    <?php foreach ($activeLanguages as $language): ?>
                        <div class="form-group">
                            <label><?= trans("business_category_name"); ?> (<?= $language->name; ?>)</label>
                            <input type="text" class="form-control" name="name_lang_<?= $language->id; ?>" placeholder="<?= trans("business_category_name"); ?>" maxlength="255" required>
                        </div>
                    <?php endforeach; ?>
                    <div class="form-group">
                        <label class="control-label"><?= trans("slug"); ?>
                            <small>(<?= trans("slug_exp"); ?>)</small>
                        </label>
                        <input type="text" class="form-control" name="slug_lang" placeholder="<?= trans("slug"); ?>">
                    </div>
                    <div class="form-group">
                        <label class="control-label"><?= trans('title'); ?> (<?= trans('meta_tag'); ?>)</label>
                        <input type="text" class="form-control" name="title_meta_tag" placeholder="<?= trans('title'); ?> (<?= trans('meta_tag'); ?>)" value="<?= old('title_meta_tag'); ?>">
                    </div>
                    <div class="form-group">
                        <label class="control-label"><?= trans('description'); ?> (<?= trans('meta_tag'); ?>)</label>
                        <textarea class="form-control form-textarea" name="description" placeholder="<?= trans('description'); ?>"><?= old('description'); ?></textarea>
                    </div>
                    <div class="form-group">
                        <label class="control-label"><?= trans('keywords'); ?> (<?= trans('meta_tag'); ?>)</label>
                        <input type="text" class="form-control" name="keywords" placeholder="<?= trans('keywords'); ?> (<?= trans('meta_tag'); ?>)" value="<?= old('keywords'); ?>">
                    </div>
                    <div class="form-group">
                        <label><?= trans('order'); ?></label>
                        <input type="number" class="form-control" name="category_order" placeholder="<?= trans('order'); ?>" value="<?= old('business_category_order'); ?>" min="1" max="99999" required>
                    </div>
                    <div class="form-group">
                        <label><?= trans("show_description_business_category_page"); ?></label>
                        <?= formRadio('show_description', 1, 0, trans("yes"), trans("no"), '0'); ?>
                    </div>
                    <div class="form-group">
                        <label><?= trans("visibility"); ?></label>
                        <?= formRadio('visibility', 1, 0, trans("show"), trans("hide"), 1); ?>
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary pull-right"><?= trans('add_business_category'); ?></button>
                </div>
            </form>
        </div>
    </div>
</div>