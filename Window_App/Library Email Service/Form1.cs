using System;
using System.IO;
using System.Diagnostics;
using System.Reflection;
using System.Windows.Forms;
using Microsoft.Win32;
using Microsoft.Win32.TaskScheduler;
namespace Library_Email_Service
{

    public partial class Form1 : Form
    {
        private System.Windows.Forms.Timer timer;
        bool triggered = false;
        private NotifyIcon trayIcon;
        private ContextMenuStrip trayMenu;

        public Form1()
        {
            Process currentProcess = Process.GetCurrentProcess();

            // Get all processes with the same name as the current process
            Process[] processes = Process.GetProcessesByName(currentProcess.ProcessName);

            // If there are more than one processes with the same name, an instance of the application is already running
            if (processes.Length > 1)
            {

                currentProcess.Kill();
            }


            InitializeComponent();
            InitializeTrayIcon();

            this.MaximizeBox = false; // Disables the maximize button

            this.FormClosing += Form1_FormClosing; // Attach the event handler
            Registrycheck();
            string[] args = Environment.GetCommandLineArgs();
            if (args.Length > 1 && args[1] == "scheduledRun")
            {
                textBox1.AppendText("Automatic Execution Started!" + Environment.NewLine);

                this.Load += Form1_Load; // Attach the event handler for the form load
                InitializeTimer();
       
            }
            else
            {
                this.Load += Form1_Load; // Attach the event handler for the form load
            }


            CheckTaskExistence();
        }

        private void Form1_Load(object sender, EventArgs e)
        {

            string phpExePath = @"C:\xampp\php\php.exe"; // Path to php.exe
            string exeDirectory = AppDomain.CurrentDomain.BaseDirectory;
            string phpScriptPath = Path.Combine(exeDirectory, "server/mailer.php");
            ProcessStartInfo startInfo = new ProcessStartInfo
            {
                FileName = phpExePath,
                Arguments = $"\"{phpScriptPath}\"",
                RedirectStandardOutput = true,
                RedirectStandardError = true,
                UseShellExecute = false,
                CreateNoWindow = true
            };

            Process process = new Process
            {
                StartInfo = startInfo
            };

            process.OutputDataReceived += (sender, output) =>
            {
                if (!string.IsNullOrEmpty(output.Data))
                {
                    BeginInvoke((MethodInvoker)(() =>
                    {
                        textBox1.AppendText("\n"+output.Data + Environment.NewLine);
                        string filePath = @"logs.ini";

                        // Text to append to the file
                        string textToAppend = output.Data + Environment.NewLine;

                        // Append text to the file
                        File.AppendAllText(filePath, textToAppend);
                    }));
                }
            };

            process.ErrorDataReceived += (sender, error) =>
            {
                if (!string.IsNullOrEmpty(error.Data))
                {
                    BeginInvoke((MethodInvoker)(() =>
                    {
                        textBox1.AppendText(error.Data + Environment.NewLine);
                    }));
                }
            };

            process.Start();
            process.BeginOutputReadLine();
            process.BeginErrorReadLine();

            process.WaitForExit();


        }
        private void InitializeTimer()
        {
            timer = new System.Windows.Forms.Timer();
            timer.Interval = 200000; // 2 mins (10000 milliseconds)
            timer.Tick += Timer_Tick;
            timer.Start();
        }

        private void Timer_Tick(object sender, EventArgs e)
        {
            timer.Stop(); // Stop the timer

            // Get the current process
            System.Diagnostics.Process currentProcess = System.Diagnostics.Process.GetCurrentProcess();

            // Terminate the process
            currentProcess.Kill();
        }


        private void InitializeTrayIcon()
        {
            trayMenu = new ContextMenuStrip();
            trayMenu.Items.Add("Exit", null, OnExit);

            trayIcon = new NotifyIcon
            {
                Text = "Library Service Email",
                Icon = SystemIcons.Application,
                ContextMenuStrip = trayMenu,
                Visible = true
            };

            trayIcon.DoubleClick += TrayIcon_DoubleClick;
        }

        private void TrayIcon_DoubleClick(object sender, EventArgs e)
        {
            this.Show(); // Show the form when tray icon is double-clicked
            this.WindowState = FormWindowState.Normal; // Show the form in normal state
        }

        private void OnExit(object sender, EventArgs e)
        {
            trayIcon.Visible = false;
            Application.Exit();
        }
        private void Form1_FormClosing(object sender, FormClosingEventArgs e)
        {
            if (e.CloseReason == CloseReason.UserClosing)
            {
                e.Cancel = true;  // Cancel the closing action
                this.Hide();      // Hide the form instead of closing
            }
        }
        private void RunTask()
        {

        }
        private void button1_Click(object sender, EventArgs e)
        {

        }


        private void button1_Click_1(object sender, EventArgs e)
        {

        }
        private void Registrycheck()
        {
            string keyPath = @"SOFTWARE\Microsoft\Windows\CurrentVersion\Run";
            string valueName = "CHMSU_SERVER_LIB"; // Value name to check existence

            RegistryKey rk = Registry.CurrentUser.OpenSubKey(keyPath);
            if (rk != null)
            {
                object value = rk.GetValue(valueName);
                if (value != null)
                {
                    toolStripMenuItem1.Text = "Off";
                }
                else
                {
                    toolStripMenuItem1.Text = "On";
                }
            }
            else
            {
                toolStripMenuItem1.Text = "On";
            }
        }
        private void toolStripMenuItem1_Click(object sender, EventArgs e)
        {
         
        }
        private void ScheduleTask()
        {
            try
            {
                using (TaskService taskService = new TaskService())
                {
                    // Create a task definition
                    TaskDefinition taskDefinition = taskService.NewTask();
                    taskDefinition.RegistrationInfo.Description = "LIBRARY EMAIL SERVICE";

                    // Set the trigger to start the task every day at 8:30 AM
                    taskDefinition.Triggers.Add(new DailyTrigger { DaysInterval = 1, StartBoundary = DateTime.Today.AddHours(8).AddMinutes(30) });

                    // Set the action to open your application with arguments
                    string exePath = Path.Combine(AppDomain.CurrentDomain.BaseDirectory, "Library Email Service.exe"); // Update with your actual application name
                    string arguments = "scheduledRun"; // Your arguments here
                    taskDefinition.Actions.Add(new ExecAction(exePath, arguments, null));

                    // Ensure the task triggers instantly if the scheduled time has passed or the task was missed
                    taskDefinition.Settings.RunOnlyIfIdle = false;
                    taskDefinition.Settings.ExecutionTimeLimit = TimeSpan.Zero;

                    // Set the task to run with the highest privileges
                    taskDefinition.Principal.RunLevel = TaskRunLevel.Highest;

                    // Register the task in the task scheduler
                    taskService.RootFolder.RegisterTaskDefinition("Email Send", taskDefinition);

                    MessageBox.Show("Ok!");
                }
            }
            catch (Exception ex)
            {
                MessageBox.Show($"Error: {ex.Message}");
            }
        }


        private void CheckTaskExistence()
        {
            using (TaskService taskService = new TaskService())
            {
                try
                {
                    Microsoft.Win32.TaskScheduler.Task task = taskService.GetTask("Email Send"); // Replace "Email Send" with your task name
                    if (task != null)
                    {
                        button2.Enabled = false;
                        button3.Enabled = true;
                        toolStripStatusLabel2.Text = "Turned on";
                    }
                    else
                    {
                        button2.Enabled = true;
                        button3.Enabled = false;
                        toolStripStatusLabel2.Text = "Not Registered";
                    }
                }
                catch (Exception ex)
                {
                    MessageBox.Show("Error: " + ex.Message);
                }
            }
        }
        private void button2_Click(object sender, EventArgs e)
        {
            ScheduleTask();
            button2.Enabled = false;
        }

        private void button3_Click(object sender, EventArgs e)
        {
            string taskName = "Email Send";

            using (TaskService taskService = new TaskService())
            {
                // Get the existing task
                Microsoft.Win32.TaskScheduler.Task task = taskService.GetTask(taskName);

                if (task != null)
                {
                    // Delete the task
                    taskService.RootFolder.DeleteTask(taskName);
                    MessageBox.Show("Removed!");
                    button2.Enabled = true;
                }
                else
                {
                    MessageBox.Show("Not found!");
                }
            }
        }

        private void button1_Click_2(object sender, EventArgs e)
        {
            string phpExePath = @"C:\xampp\php\php.exe"; // Path to php.exe
            string exeDirectory = AppDomain.CurrentDomain.BaseDirectory;
            string phpScriptPath = Path.Combine(exeDirectory, "server/mailer.php");
            ProcessStartInfo startInfo = new ProcessStartInfo
            {
                FileName = phpExePath,
                Arguments = $"\"{phpScriptPath}\"",
                RedirectStandardOutput = true,
                RedirectStandardError = true,
                UseShellExecute = false,
                CreateNoWindow = true
            };

            Process process = new Process
            {
                StartInfo = startInfo
            };

            process.OutputDataReceived += (sender, output) =>
            {
                if (!string.IsNullOrEmpty(output.Data))
                {
                    BeginInvoke((MethodInvoker)(() =>
                    {
                        textBox1.AppendText("\n" + output.Data + Environment.NewLine);

                        string filePath = @"logs.ini";

                        // Text to append to the file
                        string textToAppend = output.Data + Environment.NewLine;

                        // Append text to the file
                        File.AppendAllText(filePath, textToAppend);

                    }));
                }
            };

            process.ErrorDataReceived += (sender, error) =>
            {
                if (!string.IsNullOrEmpty(error.Data))
                {
                    BeginInvoke((MethodInvoker)(() =>
                    {
                        textBox1.AppendText(error.Data + Environment.NewLine);
                    }));
                }
            };

            process.Start();
            process.BeginOutputReadLine();
            process.BeginErrorReadLine();

            process.WaitForExit();
        }

        private void toolStripMenuItem1_Click_1(object sender, EventArgs e)
        {
            if (string.Equals(toolStripMenuItem1.Text, "On", StringComparison.OrdinalIgnoreCase))
            {
                RegistryKey rk = Registry.CurrentUser.OpenSubKey("SOFTWARE\\Microsoft\\Windows\\CurrentVersion\\Run", true);
                rk.SetValue("CHMSU_SERVER_LIB", Application.ExecutablePath);
                toolStripMenuItem1.Text = "Off";
            }
            else
            {
                RegistryKey rk = Registry.CurrentUser.OpenSubKey("SOFTWARE\\Microsoft\\Windows\\CurrentVersion\\Run", true);
                rk.DeleteValue("CHMSU_SERVER_LIB", false);
                toolStripMenuItem1.Text = "On";
            }
        }
    }
}

