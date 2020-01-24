<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Kayıt Ol';
$errors = $model->getErrors();
?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Kayıt Ol</div>

                <div class="card-body">
                    <form method="POST" action="/?r=site/register">

                        <div class="form-group row">
                            <label for="username" class="col-md-4 col-form-label text-md-right">Kullanıcı Adı</label>

                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control <?php if (isset($errors["username"])) echo "is-invalid"; ?>" name="user[username]" value="<?php echo $location->name; ?>" required autocomplete="name" autofocus>
                                <?php if (isset($errors["username"])): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <?php foreach ($errors["username"] as $error): ?>
                                            <strong><?php echo $error; ?></strong>
                                        <?php endforeach; ?>
                                    </span>
                                <?php endif; ?>
                            </div>

                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control <?php if (isset($errors["email"])) echo "is-invalid"; ?>" name="user[email]" value="" required autocomplete="email">
                                <?php if (isset($errors["email"])): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <?php foreach ($errors["email"] as $error): ?>
                                            <strong><?php echo $error; ?></strong>
                                        <?php endforeach; ?>
                                    </span>
                                <?php endif; ?>
                            </div>

                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Şifre</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control <?php if (isset($errors["password"])) echo "is-invalid"; ?>" name="user[password]" required autocomplete="new-password">
                                <?php if (isset($errors["password"])): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <?php foreach ($errors["password"] as $error): ?>
                                            <strong><?php echo $error; ?></strong>
                                        <?php endforeach; ?>
                                    </span>
                                <?php endif; ?>
                            </div>

                        </div>


                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <input name="register" value="Kayıt Ol" type="submit" class="btn btn-primary">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>