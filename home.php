<?php
get_header();
$user_id          = get_current_user_id();
$current_user     = wp_get_current_user();
$userCardNumber   = get_user_meta($user_id, 'cardNumber', true);
$userCardName     = get_user_meta($user_id, 'cardName', true);
$userCardMonth    = get_user_meta($user_id, 'cardMonth', true);
$userCardCvv      = get_user_meta($user_id, 'cardCvv', true);
$userCard         = get_user_meta($user_id, 'user_card', true);
$userCard         = !empty($userCard) ? $userCard : '';
$cardLable        = ucwords(str_replace("_", " ", $userCard));
$cardLable        = !empty($cardLable) ? $cardLable : 'Select';


$selected_Alert = get_user_meta($user_id, 'user_alert', true);
$alert          = isset($selected_Alert) ? $selected_Alert : '';
$set_Alert      = $alert['user_alert'];
?>

<section>
  <div class="wrapper" id="app">
    <div class="card-form">
      <div class="card-list">
        <div class="card-item" v-bind:class="{ '-active' : isCardFlipped }">
          <div class="card-item__side -front">
            <div class="card-item__focus" v-bind:class="{'-active' : focusElementStyle }" v-bind:style="focusElementStyle" ref="focusElement"></div>
            <div class="card-item__cover">
              <img src="<?php echo get_template_directory_uri(); ?>/assets/img/luffy.jpg" class="card-item__bg">
            </div>

            <div class="card-item__wrapper">
              <div class="card-item__top">
                <img src="https://raw.githubusercontent.com/muhammederdem/credit-card-form/master/src/assets/images/chip.png" class="card-item__chip">

              </div>
              <div class="number">
                <p>5555</p>
                <p>3345</p>
                <p>4521</p>
                <p>9656</p>
              </div>

              <div class="card-item__content">
                <label for="cardName" class="card-item__info" ref="cardName">
                  <div class="card-item__holder">Card Holder</div>
                  <transition name="slide-fade-up">
                    <div class="card-item__name" v-if="cardName.length" key="1">

                    </div>
                    <div class="card-item__name" v-else key="2">Vikram kumar Vishwakarma</div>
                  </transition>
                </label>
                <div class="card-item__date" ref="cardDate">
                  <label for="cardMonth" class="card-item__dateTitle">Expires</label>
                  <label for="cardMonth" class="card-item__dateItem">
                    <transition name="slide-fade-up">
                      <span v-else key="2">MM</span>
                    </transition>
                  </label>
                  /
                  <label for="cardYear" class="card-item__dateItem">
                    <transition name="slide-fade-up">
                      <span v-else key="2">YY</span>
                    </transition>
                  </label>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
      <form class="card-form__inner" id="submit_form">
        <div class="card-input">
          <label for="cardNumber" class="card-input__label">Card Number</label>
          <input type="text" id="cardNumber" name="cardNumber" maxlength="19" class="card-input__input" value="<?= ($userCardNumber) ?  $userCardNumber : '' ?>">
        </div>
        <div class="card-input">
          <label for="cardName" class="card-input__label">Card Holders</label>
          <input type="text" name="cardName" class="card-input__input" value="<?= ($userCardName) ?  $userCardName : '' ?>">
        </div>
        <div class="card-form__row">
          <div class="card-form__col">
            <div class="card-form__group">
              <label for="cardMonth" class="card-input__label">Expiration Date</label>
              <input type="number" class="card-input__input -select" name="cardMonth" placeholder="Month" value="<?= ($userCardMonth) ?  $userCardMonth : '' ?>">

              <input type="number" name="cardYear" min="1900" max="2099" step="1" value="2023" class="card-input__input -select" id="cardYear" placeholder="Year">

            </div>
          </div>
          <div class="card-form__col -cvv">
            <div class="card-input">
              <label for="cardCvv" class="card-input__label">CVV</label>
              <input type="text" class="card-input__input" name="cardCvv" value="<?= ($userCardCvv) ?  $userCardCvv : '' ?>">
            </div>
          </div>
        </div>

        <fieldset>
          <label for="card">Card: <span class="star">*</span></label>

          <select id="card" name="user_card">
            <optgroup label="select card option">
              <option value="<?= ($userCard) ?  $userCard : '' ?>"><?= ($cardLable) ?  $cardLable : '' ?></option>
              <option value="Visa_Debit_Card">Visa Debit Card</option>
              <option value="Mastercard_Debit_Card">Mastercard Debit Card</option>
              <option value="RuPay_Debit_Card">RuPay Debit Card</option>
              <option value="Maestro_Debit_Card">Maestro Debit Card</option>
              <option value="Mastercard_World_Debit_Card">Mastercard World Debit Card</option>
            </optgroup>
          </select>
          <br><br>

          <!-- Alerts  -->
          <?php
          $allAlert = array('SMS Alerts', 'Email Alerts', 'App Notifications');
          echo '<label>Alert Preferences: </label><br>';
          if (!empty($set_Alert)) {
            foreach ($allAlert as $select) {
              $id = strtolower($select);
              $isChecked = in_array($select, $set_Alert) ? 'checked' : '';
              echo '<input type="checkbox" id="' . $id . '" value="' . $select . '" name="user_alert[]" ' . $isChecked . '>';
              echo '<label class="light" for="' . $id . '">' . $select . '</label><br>';
            }
          } else {
            foreach ($allAlert as $select) {
              $id = strtolower($select);
              echo '<input type="checkbox" id="' . $id . '" value="' . $select . '" name="user_alert[]">';
              echo '<label class="light" for="' . $id . '">' . $select . '</label><br>';
            }
          }?>
          <br><br>
          <label for="image">Upload File:</label>
          <input type="file" name="image_upload[]" id="image" multiple>

        </fieldset>
        <button type="submit" class="card-form__button">
          Submit
        </button>
      </form>
    </div>
  </div>
</section>





<!-- Ajax  -->

<script>
  $(document).ready(function() {
    $("#submit_form").on('submit', function(e) {
      e.preventDefault();
      var formData = $(this).serialize();
      var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";


      $.ajax({
        method: 'post',
        url: ajaxurl,
        data: {
          action: 'load',
          formData: formData
        },
        success: function(response) {
          console.log('success', response);
         
          var cxc_form = new FormData($('#submit_form')[0]);
          cxc_form.append('action', 'filename_get');

          jQuery.ajax({
            type: 'POST',
            url: '<?php echo admin_url('admin-ajax.php'); ?>',
            data: cxc_form,
            contentType: false,
            processData: false,
            success: function(cxc_response) {
              alert('successfully uploaded');
            }
          });

        },
        error: function(error) {
          console.log('error', error);
        }
      });

    });


    $("#image").on('change', function(e) {
       
      var cxc_form = new FormData($('#submit_form')[0]);
          cxc_form.append('action', 'upload_file_data');

          jQuery.ajax({
            type: 'POST',
            url: '<?php echo admin_url('admin-ajax.php'); ?>',
            data: cxc_form,
            contentType: false,
            processData: false,
            success: function(cxc_response) {
            }
          });
    });
  });
</script>
<?php get_footer();?>