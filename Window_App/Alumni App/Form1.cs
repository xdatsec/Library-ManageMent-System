using System;
using System.Windows.Forms;

namespace Alumni_App
{
    public partial class Form1 : Form
    {
        public Form1()
        {
            InitializeComponent();

            // Remove the border and the title bar
            this.FormBorderStyle = FormBorderStyle.None;
            this.ControlBox = false;
            this.Text = string.Empty;

            Screen screen = Screen.FromControl(this);
            int screenWidth = screen.WorkingArea.Width;
            int screenHeight = screen.WorkingArea.Height;
            int formWidth = this.Width;
            int formHeight = this.Height;

            int left = (screenWidth - formWidth) / 2;
            int top = (screenHeight - formHeight) / 2;

            this.Location = new System.Drawing.Point(left, top);

            // Wire up the Shown event
            this.Shown += Form1_Shown;
            progressBar1.Value = 100; // Set progress to 100%
        }

        private void Form1_Shown(object sender, EventArgs e)
        {
            // Set up the timer when Form1 is shown
            System.Windows.Forms.Timer timer = new System.Windows.Forms.Timer();
            timer.Interval = 3000; // 10 seconds (in milliseconds)
            timer.Tick += Timer_Tick;
            timer.Start();

        }

        private void Timer_Tick(object sender, EventArgs e)
        {
        
            this.Hide();
            System.Windows.Forms.Timer timer = (System.Windows.Forms.Timer)sender;
            timer.Stop();


            // Create Form2 and show it
            Form2 form2 = new Form2();
            form2.ShowDialog(); // Use ShowDialog to block the thread until Form2 is closed
            this.Close();
            // Close Form1 after Form2 is closed

        }
    }
}
