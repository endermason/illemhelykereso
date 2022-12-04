package com.cityflush

import android.Manifest
import android.content.Intent
import android.content.SharedPreferences
import android.content.pm.PackageManager
import android.os.Build
import android.os.Bundle
import androidx.core.content.ContextCompat
import androidx.fragment.app.Fragment
import androidx.preference.PreferenceManager
import com.github.appintro.AppIntro2
import com.github.appintro.AppIntroFragment
import com.github.appintro.AppIntroPageTransformerType

class IntroActivity : AppIntro2() {

    //SharedPreferences - Verzió tárolása
    private lateinit var sharedPref: SharedPreferences


    /**
     *   OnBoard létrehozása...
     */
    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)

        //SharedPreferences
        sharedPref = PreferenceManager.getDefaultSharedPreferences(this)

        //Slide-ok közötti váltás beállítása.
        setTransformer(AppIntroPageTransformerType.Parallax())

        //StatusBar, NavigationBar.
        showStatusBar(true)
        setStatusBarColorRes(R.color.primaryDarkColor)
        setNavBarColorRes(R.color.primaryDarkColor)

        //Slides
        addSlide(
            AppIntroFragment.createInstance(
                title = getString(R.string.welcome_slide_title),
                description = getString(R.string.welcome_slide),
                imageDrawable = R.drawable.welcomepic,
                backgroundColorRes = R.color.primaryColor,
                titleColorRes = android.R.color.black,
                descriptionColorRes = android.R.color.black,
            )
        )

        //Értesítések...
        val slideNumber = 2
        if (Build.VERSION.SDK_INT >= Build.VERSION_CODES.TIRAMISU) {
            if (ContextCompat.checkSelfPermission(
                    this,
                    Manifest.permission.POST_NOTIFICATIONS
                ) != PackageManager.PERMISSION_GRANTED
            ) {
                //Engedélyt akarunk!!!
                askForPermissions(
                    permissions = arrayOf(Manifest.permission.POST_NOTIFICATIONS),
                    slideNumber = slideNumber
                )

                //Engedély kérése - magyarázzuk meg a felhasználónak, hogy miért kell nekünk
                addSlide(
                    AppIntroFragment.createInstance(
                        title = getString(R.string.intro_notif_title),
                        description = getString(R.string.intro_notifications_text),
                        imageDrawable = R.drawable.notifresized,
                        backgroundColorRes = R.color.primaryColor,
                        titleColorRes = android.R.color.black,
                        descriptionColorRes = android.R.color.black,
                    )
                )
            }
        }
    }


    /**
     *   Átlépte az egészet...
     */
    override fun onSkipPressed(currentFragment: Fragment?) {
        super.onSkipPressed(currentFragment)
        openMain()
    }

    /**
     *   Befejezte...
     */
    override fun onDonePressed(currentFragment: Fragment?) {
        super.onDonePressed(currentFragment)
        openMain()
    }


    /**
     *   MainActivity megnyitása
     */
    private fun openMain() {
        //Verzió mentése - Csak akkor, ha vagy végignézte, vagy skippelte.
        val editor = sharedPref.edit()
        editor.putInt(getString(R.string.version), BuildConfig.VERSION_CODE)
        editor.apply()

        //Mehet!
        val intent = Intent(this, MainActivity::class.java)
        startActivity(intent)
    }

}
