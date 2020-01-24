<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm */

$this->pageTitle = Yii::app()->name . ' - Giriş Yap';

$errors = $model->getErrors();
?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Giriş Yap</div>

                <div class="card-body">
                    <form method="POST" action="/?r=site/login">

                        <div class="form-group row">
                            <label for="username" class="col-md-4 col-form-label text-md-right">Username</label>

                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control <?php if (isset($errors["username"])) echo "is-invalid"; ?>" name="user[username]" value=""
                                      required autofocus>
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
                            <label for="password" class="col-md-4 col-form-label text-md-right">Şifre</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="user[password]" required
                                       autocomplete="current-password">

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
                            <div class="col-md-12">
                                <input name="login" value="Login" type="submit" class="btn btn-block btn-primary">

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
