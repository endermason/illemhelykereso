package com.cityflush

import android.content.Context
import android.net.ConnectivityManager
import android.net.NetworkCapabilities
import android.os.Build
import java.util.*

/**
 *   Van-e net?
 */
fun isNetworkAvailable(context: Context): Boolean {
    val cm = context.getSystemService(Context.CONNECTIVITY_SERVICE) as ConnectivityManager?

    cm?.let {
        //Ha 23 (M) <= VERZIÓ
        if (Build.VERSION.SDK_INT >= Build.VERSION_CODES.M) {
            it.getNetworkCapabilities(cm.activeNetwork)?.let { nc ->
                return when {
                    nc.hasTransport(NetworkCapabilities.TRANSPORT_WIFI) -> true
                    nc.hasTransport(NetworkCapabilities.TRANSPORT_CELLULAR) -> true
                    else -> false
                }
            }
        }
        //Ha VERZIÓ < 23 (M)
        else {
            @Suppress("Deprecation")
            it.activeNetworkInfo?.let { ni ->
                return when (ni.type) {
                    ConnectivityManager.TYPE_WIFI -> true
                    ConnectivityManager.TYPE_MOBILE -> true
                    else -> false
                }
            }
        }
    }

    return false
}
