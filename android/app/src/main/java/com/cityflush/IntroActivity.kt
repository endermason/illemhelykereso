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

    //SharedPreferences - Verzi� t�rol�sa
    private lateinit var sharedPref: SharedPreferences


    /**
     *   OnBoard l�trehoz�sa...
     */
    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)

        //SharedPreferences
        sharedPref = PreferenceManager.getDefaultSharedPreferences(this)

        //Slide-ok k�z�tti v�lt�s be�ll�t�sa.
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

        //�rtes�t�sek...
        val slideNumber = 2
        if (Build.VERSION.SDK_INT >= Build.VERSION_CODES.TIRAMISU) {
            if (ContextCompat.checkSelfPermission(
                    this,
                    Manifest.permission.POST_NOTIFICATIONS
                ) != PackageManager.PERMISSION_GRANTED
            ) {
                //Enged�lyt akarunk!!!
                askForPermissions(
                    permissions = arrayOf(Manifest.permission.POST_NOTIFICATIONS),
                    slideNumber = slideNumber
                )

                //Enged�ly k�r�se - magyar�zzuk meg a felhaszn�l�nak, hogy mi�rt kell nek�nk
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
     *   �tl�pte az eg�szet...
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
     *   MainActivity megnyit�sa
     */
    private fun openMain() {
        //Verzi� ment�se - Csak akkor, ha vagy v�gign�zte, vagy skippelte.
        val editor = sharedPref.edit()
        editor.putInt(getString(R.string.version), BuildConfig.VERSION_CODE)
        editor.apply()

        //Mehet!
        val intent = Intent(this, MainActivity::class.java)
        startActivity(intent)
    }

}
