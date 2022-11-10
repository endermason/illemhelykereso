package com.cityflush.ui.main

import android.annotation.SuppressLint
import android.os.Bundle
import androidx.fragment.app.Fragment
import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import android.webkit.GeolocationPermissions
import android.webkit.WebChromeClient
import android.webkit.WebView
import android.webkit.WebViewClient
import androidx.activity.OnBackPressedCallback
import com.cityflush.databinding.FragmentMainBinding

class MainFragment : Fragment() {

    companion object {
        fun newInstance() = MainFragment()
    }


    /**
     *   Data Binding
     */
    private lateinit var binding: FragmentMainBinding


    /**
     *   onCreateView...
     */
    override fun onCreateView(
        inflater: LayoutInflater,
        container: ViewGroup?,
        savedInstanceState: Bundle?
    ): View {
        /**
         *   Weboldal címe
         */
        val url = "https://maps.google.com/" //TODO


        //VIEW
        /**
         *   Layout létrehozás, összerendelés = DataBinding
         */
        binding = FragmentMainBinding.inflate(inflater)


        /**
         *   WebView beállítása
         */
        with(binding.web) {
            with(settings) {
                @SuppressLint("SetJavaScriptEnabled")
                javaScriptEnabled = true
                //builtInZoomControls = true
                useWideViewPort = true
                loadWithOverviewMode = true
            }
            setInitialScale(1)
            scrollBarStyle = View.SCROLLBARS_OUTSIDE_OVERLAY
            webViewClient = object : WebViewClient() {
                //Ha végzett a view a betöltéssel, akkor eltűnteti a loader-t
                override fun onPageFinished(view: WebView?, url: String?) {
                    binding.progress.visibility = View.GONE
                }
            }
            //WebChromeClient
            webChromeClient = object : WebChromeClient() {
                //Töltés közben a loader progress frissítése
                override fun onProgressChanged(view: WebView, newProgress: Int) {
                    binding.progress.progress = newProgress
                }

                override fun onGeolocationPermissionsShowPrompt(
                    origin: String?,
                    callback: GeolocationPermissions.Callback?
                ) {
                    callback?.invoke(origin, true, false)
                }
            }
            loadUrl(url) //URL betöltése
        }


        /**
         *   Visszalépés
         */
        requireActivity().onBackPressedDispatcher.addCallback(
            viewLifecycleOwner,
            object : OnBackPressedCallback(true) {
                override fun handleOnBackPressed() {
                    //Ha vissza tud lépni
                    if (binding.web.canGoBack()) {
                        //Visszatöltés
                        binding.web.goBack()
                    }
                    else {
                        //Bezárja az appot
                        requireActivity().finish()
                    }
                }
            })


        //VIEW
        return binding.root
    }

}
