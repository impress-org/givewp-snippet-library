<?php

add_action('givewp_donation_form_schema', static function (Give\Framework\FieldsAPI\DonationForm $form) {
    $field = Give\Framework\FieldsAPI\HTML::make('DarkLightToggle')
        ->html('<div class="toggle-container">
  <label class="switch">
    <input type="checkbox" id="theme-toggle"  data-theme-toggle aria-label="Light Mode">
    <span class="slider"></span>
  </label>
  <p id="toggle-status">Light Mode</p>
</div>
');
    $form->insertAfter('email', $field);

});

add_action( 'givewp_donation_form_enqueue_scripts', function(){
    ?>
      <script>
		document.addEventListener('DOMContentLoaded', function(){
        /**
* Utility function to calculate the current theme setting.
* Look for a local storage value.
* Fall back to system setting.
* Fall back to light mode.
*/
function calculateSettingAsThemeString({ localStorageTheme, systemSettingDark }) {
  if (localStorageTheme !== null) {
    return localStorageTheme;
  }

  if (systemSettingDark.matches) {
    return "dark";
  }

  return "light";
}

/**
* Utility function to update the button text and aria-label.
*/
function updateButton({ buttonEl, isDark, buttonTextEl }) {
  const newCta = isDark ? "Light mode" : "Dark mode";
  // use an aria-label if you are omitting text on the button
  // and using a sun/moon icon, for example
  buttonEl.setAttribute("aria-label", newCta);
  buttonText.textContent = newCta;
}

/**
* Utility function to update the theme setting on the html tag
*/
function updateThemeOnHtmlEl({ theme }) {
  document.querySelector(".givewp-donation-form").setAttribute("data-theme", theme);
}


/**
* On page load:
*/

/**
* 1. Grab what we need from the DOM and system settings on page load
*/
const button = document.querySelector("[data-theme-toggle]");
const buttonText = document.getElementById("toggle-status");
const localStorageTheme = localStorage.getItem("theme");
const systemSettingDark = window.matchMedia("(prefers-color-scheme: dark)");

/**
* 2. Work out the current site settings
*/
let currentThemeSetting = calculateSettingAsThemeString({ localStorageTheme, systemSettingDark });

/**
* 3. Update the theme setting and button text accoridng to current settings
*/
updateButton({ buttonEl: button, isDark: currentThemeSetting === "dark", buttonTextEl: buttonText });
updateThemeOnHtmlEl({ theme: currentThemeSetting });

/**
* 4. Add an event listener to toggle the theme
*/
button.addEventListener("click", (event) => {
  const newTheme = currentThemeSetting === "dark" ? "light" : "dark";

  localStorage.setItem("theme", newTheme);
  updateButton({ buttonEl: button, isDark: newTheme === "dark" });
  updateThemeOnHtmlEl({ theme: newTheme });

  currentThemeSetting = newTheme;
}); 
	}); 
	
    </script>
<?php
});