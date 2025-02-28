<style>
    .edit-avatar{ width: 20%; }
    .btn-file-upload{
        top: 180px;
    }
    .phone-flex{
    font-size: .775rem;
    display: flex;
    flex-wrap: nowrap;
    flex-direction: row;
    align-items: center;
    }
    .phone-flex input {
        width: 80%;
    }
    .phone-flex input:first-child {
        padding: 10px;
        margin-right:5px;
        width:20%;
    }
</style>    
<div id="wrapper">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="nav-breadcrumb" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= langBaseUrl(); ?>"><?= trans("home"); ?></a></li>
                        <li class="breadcrumb-item"><a href="<?= generateUrl('settings', 'edit_profile'); ?>"><?= trans("profile_settings"); ?></a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?= esc($title); ?></li>
                    </ol>
                </nav>
                <h1 class="page-title"><?= trans("profile_settings"); ?></h1>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 col-md-3">
                <div class="row-custom">
                    <?= view("settings/_tabs"); ?>
                </div>
            </div>
            <div class="col-sm-12 col-md-9">
                <div class="row-custom">
                    <div class="sidebar-tabs-content">
                        <?= view('partials/_messages'); ?>
                        <form action="<?= base_url('edit-profile-post'); ?>" method="post" id="form_validate" enctype="multipart/form-data">
                            <?= csrf_field(); ?>
                            <div class="form-group">
                                <div class="edit-avatar">
                                            <a class="btn btn-md btn-custom btn-file-upload">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 16 16">
                                                    <path d="M10.5 8.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                                                    <path d="M2 4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2h-1.172a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 9.172 2H6.828a2 2 0 0 0-1.414.586l-.828.828A2 2 0 0 1 3.172 4H2zm.5 2a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1zm9 2.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0z"/>
                                                </svg>
                                                <input type="file" name="file" size="40" accept=".jpg, .jpeg, .webp, .png, .gif" data-img-id="img_preview_avatar" onchange="showImagePreview(this);">
                                            </a>
                                            <img src="<?= getUserAvatar(user()); ?>" alt="<?= esc(getUsername(user())); ?>" id="img_preview_avatar" class="img-thumbnail" width="180" height="180">
                                </div>
                              </div>
                            <div class="form-group">
                                <label class="control-label">
                                    <?= trans("email_address"); ?>
                                    <?php if ($generalSettings->email_verification == 1): ?>
                                        <?php if (user()->email_status == 1): ?>
                                            <small class="text-success">(<?= trans("confirmed"); ?>)</small>
                                        <?php else: ?>
                                            <small class="text-danger">(<?= trans("unconfirmed"); ?>)</small>
                                            <a href="javascript:void(0)" class="color-link link-underlined font-weight-normal" onclick="sendActivationEmail('<?= user()->token; ?>', 'profile');"><?= trans("resend_activation_email"); ?></a>
                                            <div class="display-inline-block font-weight-normal m-l-5" id="confirmation-result-profile"></div>
                                        <?php endif;
                                    endif; ?>
                                </label>
                                <input type="email" name="email" class="form-control form-input" value="<?= esc(user()->email); ?>" placeholder="<?= trans("email_address"); ?>" required>
                            </div>
                            <div class="form-group">
                               <label class="control-label"><?= trans("country"); ?></label>
                                <select name="country" id="country" class="form-control auth-form-se" required>
                                    <option value=""><?= trans("country"); ?></option>
                                    <?php if (!empty($countries)):
                                        foreach ($countries as $item):
                                    ?>
                                    <option value="<?=$item->id;?>" data-pcode="<?=$item->phonecode;?>" <?=($item->id == user()->country_id)?'selected':'';?>><?=$item->name;?></option>
                                    <?php 
                                     endforeach;
                                   endif; ?>
                                </select>
                            </div>                            
                            <div class="form-group">
                                <label class="control-label"><?= trans("company_name"); ?></label>
                                <input type="text" name="company" class="form-control form-input" value="<?= esc(user()->company); ?>" placeholder="<?= trans("company_name"); ?>" maxlength="200" required>
                            </div>  
                            <div class="form-group">
                            <label class="control-label"><?= trans("business_type"); ?></label>
                            <select name="business_type" class="form-control auth-form-se" required>
                                    <option value=""><?= trans("business_type"); ?></option>
                                    <?php if (!empty($business_type)):
                                        foreach ($business_type as $item):
                                    ?>
                                    <option value="<?=$item->id;?>" <?=($item->id == user()->business_type)?'selected':'';?>><?=str_replace($activeLangID.':::','',$item->name);?></option>
                                    <?php 
                                     endforeach;
                                   endif; ?>
                                </select>
                            </div>                           
                            <div class="form-group">
                                <label class="control-label"><?= trans("slug"); ?></label>
                                <input type="text" name="slug" class="form-control form-input" value="<?= esc(user()->slug); ?>" placeholder="<?= trans("slug"); ?>" maxlength="200" required>
                            </div>
                            <div class="form-group">
                                <label class="control-label"><?= trans("first_name"); ?></label>
                                <input type="text" name="first_name" class="form-control form-input" value="<?= esc(user()->first_name); ?>" placeholder="<?= trans("first_name"); ?>" maxlength="250" required>
                            </div>
                            <div class="form-group">
                                <label class="control-label"><?= trans("last_name"); ?></label>
                                <input type="text" name="last_name" class="form-control form-input" value="<?= esc(user()->last_name); ?>" placeholder="<?= trans("last_name"); ?>" maxlength="250" required>
                            </div>
                            <div class="form-group">
                                <label class="control-label"><?= trans("phone_number"); ?></label>
                            </div>
                            <div class="form-group phone-flex">
                                <input type="text" name="country_code" id="country_code" class="form-control auth-form-input" placeholder="<?= trans("country_code"); ?>" value="<?= esc(user()->country_code); ?>" maxlength="255" required readonly>
                                <input type="text" name="phone_number" class="form-control auth-form-input" placeholder="<?= trans("phone_number"); ?>" value="<?= esc(user()->phone_number); ?>" maxlength="255" required>
                            </div>
                            <div class="form-group">
                                <label class="control-label"><?= trans("tax_registration_number"); ?></label>
                                <input type="text" name="tax_registration_number" class="form-control form-input" value="<?= esc(user()->tax_registration_number); ?>" placeholder="<?= trans("tax_registration_number"); ?>" maxlength="255">
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" name="send_email_new_message" value="1" id="send_email_new_message" class="custom-control-input" <?= user()->send_email_new_message == 1 ? 'checked' : ''; ?>>
                                    <label for="send_email_new_message" class="custom-control-label"><?= trans("email_option_send_email_new_message"); ?></label>
                                </div>
                            </div>
                            <?php if ($generalSettings->show_vendor_contact_information == 1 &&  user()->is_used_free_plan == 0): ?>
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" name="show_phone" value="1" id="checkbox_show_phone" class="custom-control-input" <?= user()->show_phone == 1 ? 'checked' : ''; ?>>
                                        <label for="checkbox_show_phone" class="custom-control-label"><?= trans("show_my_phone"); ?></label>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <button type="submit" name="submit" value="update" class="btn btn-md btn-custom m-t-10"><?= trans("save_changes") ?></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>
    $( document ).ready(function() {

      $(document).on("change", "#country", function (e) {
        var pcode = $(this).find(':selected').attr('data-pcode');
        if (pcode != '') {
            $('#country_code').val('+'+pcode);
        }
    });
});
</script>