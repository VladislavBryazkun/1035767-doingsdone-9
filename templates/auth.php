<section class="content__side">
    <p class="content__side-info">Если у вас ещё нет аккаунта, зарегестрируйтесь на сайте</p>

    <a class="button button--transparent content__side-button" href="register.php">Зарегестрироваться</a>
</section>

<main class="content__main">
    <h2 class="content__main-heading">Вход на сайт</h2>

    <form class="form" action="auth.php" method="post" autocomplete="off">
        <div class="form__row">
            <label class="form__label" for="email">E-mail <sup>*</sup></label>

            <input class="form__input <?= isset($errors['email']) ? 'form__input--error' : '' ?>"
                   type="text" name="email" id="email" value="<?= $fields['email'] ?? '' ?>"
                   placeholder="Введите e-mail">

            <p class="form__message"><?= $errors['email'] ?? '' ?></p>
        </div>

        <div class="form__row">
            <label class="form__label" for="password">Пароль <sup>*</sup></label>

            <input class="form__input <?= isset($errors['password']) ? 'form__input--error' : '' ?> "
                   type="password" name="password" id="password" value=""
                   placeholder="Введите пароль">
            <p class="form__message"><?= $errors['password'] ?? '' ?></p>
        </div>
        <div class="form__row form__row--controls">
            <p class="error-message"><?= $errors['info'] ?? '' ?></p>
            <input class="button" type="submit" name="" value="Войти">
        </div>


    </form>

</main>
