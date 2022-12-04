package com.cityflush

import android.content.Intent
import android.os.Handler
import android.os.Looper
import androidx.appcompat.app.AppCompatActivity
import androidx.preference.PreferenceManager

class Splash() : AppCompatActivity() {

    override fun onResume() {
        super.onResume()

        //SharedPreferences
        val sharedPref = PreferenceManager.getDefaultSharedPreferences(this)

        //200 másodpercig várakozunk
        Handler(Looper.getMainLooper()).postDelayed({
            //Verzió lekérése
            val version = sharedPref.getInt(getString(R.string.version), -1)

            //Most települt vagy frissült?
            if (version == BuildConfig.VERSION_CODE) {
                startActivity(Intent(this@Splash, MainActivity::class.java))
            } else {
                startActivity(Intent(this@Splash, IntroActivity::class.java))
            }

            overridePendingTransition(android.R.anim.fade_in, android.R.anim.fade_out)
            finish()
        }, 200L)
    }

}
