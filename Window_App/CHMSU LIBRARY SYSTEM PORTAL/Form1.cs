using Microsoft.Web.WebView2.Core;
using Microsoft.Web.WebView2.WinForms;
using System;
using System.Security.Policy;

namespace CHMSU_LIBRARY_SYSTEM_PORTAL
{
    public partial class Form1 : Form
    {
        private WebView2 webView;

        public Form1()
        {
            InitializeComponent();
            this.FormBorderStyle = FormBorderStyle.None;
            this.ControlBox = false;

            Screen screen = Screen.FromControl(this);
            int screenWidth = screen.WorkingArea.Width;
            int screenHeight = screen.WorkingArea.Height;
            int formWidth = this.Width;
            int formHeight = this.Height;

            int left = (screenWidth - formWidth) / 2;
            int top = (screenHeight - formHeight) / 2;

            this.Location = new System.Drawing.Point(left, top);

            // Set the default state to maximize
            this.WindowState = FormWindowState.Maximized;
            string url = "";
            string configFileContent = ReadConfigFile("config.ini"); // Provide the path to your config file
            if (string.IsNullOrEmpty(configFileContent))
            {
                DialogResult result1 = MessageBox.Show("The Config.ini is empty or missing", "Fatal Error!", MessageBoxButtons.OKCancel);

                if (result1 == DialogResult.OK)
                {
                    // Exit the application
                    Environment.Exit(0);
                }

            }
            else if (Uri.TryCreate(configFileContent, UriKind.Absolute, out Uri result) && (result.Scheme == Uri.UriSchemeHttp || result.Scheme == Uri.UriSchemeHttps))
            {
                url = configFileContent;

                webView = new WebView2();
                webView.Source = new Uri(url);

                // Dock the WebView to fill the entire panel1
                webView.Dock = DockStyle.Fill;

                // Add WebView to panel1
                panel1.Controls.Add(webView);

                // Set panel1's Dock property to Top and AutoSize to automatically adjust its width
                panel1.Dock = DockStyle.Fill;


                // Set panel2's Dock property to Top to prevent it from covering the top
                panel2.Dock = DockStyle.Top;
                panel1.Padding = new Padding(0, 20, 0, 0); // 10 pixels of top margin

            }
            else
            {
                DialogResult results = MessageBox.Show("The Config.ini is not valid or missing", "Fatal Error!", MessageBoxButtons.OKCancel);

                if (results == DialogResult.OK)
                {
                    // Exit the application
                    Environment.Exit(0);
                }
            }


            // Bring the ToolStrip to the front to make it render above the WebView content


            // Wait for the control to be initialized and handle any exceptions
            try
            {
                webView.EnsureCoreWebView2Async(null);
            }
            catch (Exception ex)
            {
                MessageBox.Show("An error occurred while initializing WebView2: " + ex.Message);
            }

            // Register an event handler to inject JavaScript to prevent the context menu
            webView.CoreWebView2InitializationCompleted += WebView_CoreWebView2InitializationCompleted;
        }
        private string ReadConfigFile(string configFile)
        {
            if (File.Exists(configFile))
            {
                try
                {
                    using (StreamReader reader = new StreamReader(configFile))
                    {
                        return reader.ReadToEnd(); // Read the entire file content as a string
                    }
                }
                catch (Exception ex)
                {
                    MessageBox.Show("An error occurred while reading the config file: " + ex.Message);
                }
            }
            else
            {
                MessageBox.Show("Config file does not exist.");
            }

            return string.Empty; // Return an empty string if there was an error or the file doesn't exist
        }
        private void WebView_CoreWebView2InitializationCompleted(object sender, CoreWebView2InitializationCompletedEventArgs e)
        {
            try
            {
                // Inject JavaScript code to prevent the context menu
                webView.CoreWebView2.AddScriptToExecuteOnDocumentCreatedAsync("document.addEventListener('contextmenu', event => event.preventDefault());");
            }
            catch (Exception ex)
            {
                MessageBox.Show("An error occurred while injecting JavaScript: " + ex.Message);
            }
        }

        private void toolStripLabel2_Click(object sender, EventArgs e)
        {
            // Read the URL from the configuration file
            string configFileContent = ReadConfigFile("config.ini"); // Provide the path to your config file

            // Check if the config file contains a valid URL
            if (Uri.TryCreate(configFileContent, UriKind.Absolute, out Uri uriResult) && (uriResult.Scheme == Uri.UriSchemeHttp || uriResult.Scheme == Uri.UriSchemeHttps))
            {
                // Set the WebView2 control's source to the URL from the config file
                webView.Source = new Uri(configFileContent);
            }
            else
            {
                // Handle the case where the URL from the config file is not valid
                MessageBox.Show("Invalid URL in config file.");
            }
        }

        private bool isFullscreen = false; // Track the fullscreen state

        private void toolStripLabel3_Click(object sender, EventArgs e)
        {
            if (webView != null && webView.CoreWebView2 != null)
            {
                // Execute JavaScript to trigger a hard reload
                webView.CoreWebView2.ExecuteScriptAsync("location.reload(true);");
            }
        }

        private void toolStripLabel4_Click(object sender, EventArgs e)
        {
            Application.Exit(); // Completely exit the application

        }
    }
}
