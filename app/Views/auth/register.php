<style>
/** Aqt **/
.auth-box .row {
    border: 1px solid #ccc;
    width: 95%;
}
.auth-box .title {
    width: 40%;
    display: inline-block;
    font-size: 17px;
    font-weight: 600;
    text-align: left;
    margin: 15px 0px 20px 0px;
}
.auth-box span.p-social-media.m-0.m-t-15 {
    font-size: .775rem;
}

.auth-box span.p-social-media.m-0.m-t-15 a{
    color: #1f87c0 !important;
}

.auth-form-input {
    margin-bottom: 2px;
    box-shadow: none !important;
    border: 0;
    outline: none !important;
    color: #494949;
    height: 35px;
    font-size: .775rem;
    line-height: 18px;
    padding: 10px 20px;
    box-shadow: none;
    border-radius: 4px;
    border: 1px solid #e6e6e6;
}

label.custom-control-label {
    font-size: .775rem;
}

.link-terms strong {
    color: #1f87c0!important;
    font-weight: 600 !important;
    text-decoration: none;
}

select.form-control{
    font-size: .775rem;
}
.radio-flex{
    font-size: .775rem;
    margin-left: 20px;
    display: flex;
    flex-wrap: nowrap;
    flex-direction: row;
    align-items: center;
}

.radio-flex span {
    width: 75px;
}

.radio-flex span.rdinput {
    width: 20px;
}

.radio-flex input[type=radio]{
    width: auto;
}

.input-flex{
    font-size: .775rem;
    display: flex;
    flex-wrap: nowrap;
    flex-direction: row;
    align-items: center;
}
.input-flex input:first-child {
    margin-right:5px;
}
.input-flex input {
    width: 50%;
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

.pwd_guide { font-size: .675rem; color: burlywood;} 
.custom-control-label {
    font-size: .675rem !important;
    color: #9aa2aa;
}
.btn-block {
    width: 60%;
    padding: 5px;
    border-radius: 5px;
    background-color: #1f87c0;
    border-color: #1f87c0;
}
/** end **/
</style>

<div id="wrapper">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="nav-breadcrumb" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= langBaseUrl(); ?>"><?= trans("home"); ?></a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?= trans("register"); ?></li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="auth-container">
            <div class="auth-box">
                <div class="row">
                    <div class="col-12">
                        <span class="title"><?= trans("register_now"); ?></span>
                        <span class="p-social-media m-0 m-t-15"><?= trans("have_account"); ?>&nbsp;<a href="javascript:void(0)" class="link font-600" data-toggle="modal" data-target="#loginModal"><?= trans("sign_in"); ?></a></span>
                        <form action="<?= base_url('register-post'); ?>" method="post" id="form_validate" class="validate_terms" <?= $baseVars->recaptchaStatus ? 'onsubmit="checkRecaptchaRegisterForm(this);"' : ''; ?>>
                            <?= csrf_field(); ?>
                            <div class="social-login">
                                <?= view('auth/_social_login', ['orText' => trans("register_with_email")]); ?>
                            </div>
                            <div id="result-register">
                                <?= view('partials/_messages'); ?>
                            </div>
                            <div class="spinner display-none spinner-activation-register">
                                <div class="bounce1"></div>
                                <div class="bounce2"></div>
                                <div class="bounce3"></div>
                            </div>
                            <div class="form-group">
                                <select name="country" id="country" class="form-control auth-form-se" required>
                                    <option value=""><?= trans("country"); ?></option>
                                    <?php if (!empty($countries)):
                                        foreach ($countries as $item):
                                    ?>
                                    <option value="<?=$item->id;?>" data-pcode="<?=$item->phonecode;?>"><?=$item->name;?></option>
                                    <?php 
                                     endforeach;
                                   endif; ?>
                                </select>
                            </div>
                            <div class="form-group radio-flex">
                            <span class="rdinput"><input type="radio" name="user_type" id="utype_1" class="form-control auth-form-input" value="2" required></span>
                            <span><?= trans("seller"); ?></span>
                            <span class="rdinput"><input type="radio" name="user_type" id="utype_2" class="form-control auth-form-input" value="3" required></span>
                            <span><?= trans("buyer"); ?></span>
                            </div> 
                            <div class="form-group">
                                <input type="text" name="company" class="form-control auth-form-input" placeholder="<?= trans("company_name"); ?>" value="<?= old("company"); ?>" maxlength="255" required>
                            </div> 
                            <div class="form-group">
                            <select name="business_type" class="form-control auth-form-se" required>
                                    <option value=""><?= trans("business_type"); ?></option>
                                    <?php if (!empty($business_type)):
                                        foreach ($business_type as $item):
                                    ?>
                                    <option value="<?=$item->id;?>"><?=str_replace($activeLangID.':::','',$item->name);?></option>
                                    <?php 
                                     endforeach;
                                   endif; ?>
                                </select>
                            </div>                           
                            <div class="form-group">
                                <select name="package" id="package" class="form-control auth-form-se" required>
                                    <option value=""><?= trans("select_package"); ?></option>
                                    <?php if (!empty($plans)):
                                        foreach ($plans as $item):
                                         $plan = '';   
                                         $plan = unserialize($item->title_array); 
                                         $plan_name = '';
                                           if($activeLangID == $plan[0]['lang_id']){
                                             $plan_name = $plan[0]['title'];
                                           }else{
                                              continue;
                                           }   
                                    ?>
                                    <option value="<?=$item->id;?>"><?=$plan_name;?></option>
                                    <?php 
                                     endforeach;
                                   endif; ?>
                                </select>
                            </div>                                                       
                            <div class="form-group input-flex">
                                <input type="text" name="first_name" class="form-control auth-form-input" placeholder="<?= trans("first_name"); ?>" value="<?= old("first_name"); ?>" maxlength="255" required>
                                <input type="text" name="last_name" class="form-control auth-form-input" placeholder="<?= trans("last_name"); ?>" value="<?= old("last_name"); ?>" maxlength="255" required>
                            </div>
                            <div class="form-group">
                                <input type="email" name="email" class="form-control auth-form-input" placeholder="<?= trans("business_email_address"); ?>" value="<?= old("email"); ?>" maxlength="255" required>
                            </div>
                            <div class="form-group phone-flex">
                                <input type="text" name="country_code" id="country_code" class="form-control auth-form-input" placeholder="<?= trans("country_code"); ?>" value="<?= old("country_code"); ?>" maxlength="255" required readonly>
                                <input type="text" name="phone_number" class="form-control auth-form-input" placeholder="<?= trans("phone_number"); ?>" value="<?= old("phone_number"); ?>" maxlength="255" required>
                            </div>                            
                            <div class="form-group">
                                <input type="password" name="password" class="form-control auth-form-input" placeholder="<?= trans("password"); ?>" value="<?= old("password"); ?>" minlength="6" maxlength="255" required>
                                <span class="pwd_guide"><?= trans("password_guide"); ?></span>
                            </div>
                            <div class="form-group">
                                <input type="password" name="confirm_password" class="form-control auth-form-input" placeholder="<?= trans("password_confirm"); ?>" maxlength="255" required>
                            </div>
                            <div class="form-group m-t-5 m-b-15">
                                <div class="custom-control custom-checkbox custom-control-validate-input">
                                    <input type="checkbox" class="custom-control-input" name="terms" id="checkbox_terms" required>
                                    <label for="checkbox_terms" class="custom-control-label"><?= trans("terms_conditions_exp"); ?>&nbsp;
                                        <?php $pageTerms = getPageByDefaultName("terms_conditions", selectedLangId());
                                        if (!empty($pageTerms)): ?>
                                            <a href="<?= generateUrl($pageTerms->page_default_name); ?>" class="link-terms" target="_blank"><strong><?= esc($pageTerms->title); ?></strong></a>
                                        <?php endif; ?>
                                    </label>
                                </div>
                            </div>
                            <?php if ($baseVars->recaptchaStatus): ?>
                                <div class="form-group m-b-15">
                                    <div class="display-flex justify-content-center">
                                        <?php reCaptcha('generate'); ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <div class="form-group">
                                <button type="submit" class="btn btn-custom btn-block"><?= trans("register_now"); ?></button>
                            </div>
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

    $(document).on("change", "#utype_2", function (e) {
        $("#package").val($("#package option:first").val());
        $('#package').attr('disabled', true);
    });  

    $(document).on("change", "#utype_1", function (e) {
        $('#package').attr('disabled', false);
    });  
});
</script>