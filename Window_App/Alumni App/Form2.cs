using Microsoft.VisualBasic.ApplicationServices;
using MySqlConnector;
using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Security.Policy;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;

namespace Alumni_App
{

    public partial class Form2 : Form
    {

        string constring = "";

        public Form2()
        {
            InitializeComponent();
            constring = ReadConfigFile("sqlconf.ini");
            Screen screen = Screen.FromControl(this);
            int screenWidth = screen.WorkingArea.Width;
            int screenHeight = screen.WorkingArea.Height;
            int formWidth = this.Width;
            int formHeight = this.Height;

            int left = (screenWidth - formWidth) / 2;
            int top = (screenHeight - formHeight) / 2;

            this.Location = new System.Drawing.Point(left, top);

            this.MaximizeBox = false; // Disable the Maximize button
            this.FormBorderStyle = FormBorderStyle.FixedSingle; // Disable resizing

            BindGrid();
            RefreshDataGridView();



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

        private void BindGrid()
        {
            try
            {
                using (MySqlConnection con = new MySqlConnection(constring))
                {
                    con.Open();
                    using (MySqlCommand cmd = new MySqlCommand("SELECT AlumniID, FirstName, LastName, MiddleName FROM alumni", con))
                    {
                        using (MySqlDataAdapter sda = new MySqlDataAdapter(cmd))
                        {
                            using (DataTable dt = new DataTable())
                            {
                                sda.Fill(dt);
                                dataGridView1.DataSource = dt;

                                dataGridView1.Columns["AlumniID"].ReadOnly = true;
                                dataGridView1.Columns["FirstName"].Width = 200;
                                dataGridView1.Columns["LastName"].Width = 200;
                                dataGridView1.Columns["MiddleName"].Width = 200;
                            }
                        }
                    }
                    con.Close();
                }
            }
            catch (MySqlException ex)
            {
                // Handle MySQL connection error
                MessageBox.Show("Connection error: " + ex.Message, "Error", MessageBoxButtons.OK, MessageBoxIcon.Error);

                // Ask the user if they want to exit the application
                DialogResult result = MessageBox.Show("Database not found! or credential error please check sqlconf.ini", "Fatal Error!", MessageBoxButtons.OK, MessageBoxIcon.Error);

                if (result == DialogResult.Yes)
                {
                    Application.Exit(); // Close the application's main message loop

                    // If the application is still running in the background, force it to exit
                    Environment.Exit(0);
                }
                else
                {
                    Application.Exit(); // Close the application's main message loop

                    // If the application is still running in the background, force it to exit
                    Environment.Exit(0);
                }
            }
        }


        private void DataGridView1_CellValueChanged(object sender, DataGridViewCellEventArgs e)
        {
            if (e.RowIndex >= 0 && e.ColumnIndex >= 0)
            {
                // Get the updated cell value
                string columnName = dataGridView1.Columns[e.ColumnIndex].Name;
                string newValue = dataGridView1.Rows[e.RowIndex].Cells[e.ColumnIndex].Value.ToString();
                int recordId = (int)dataGridView1.Rows[e.RowIndex].Cells["AlumniID"].Value; // Assumes you have an ID column

                // Update the database with the new value
                string updateSql = $"UPDATE alumni SET {columnName} = @NewValue WHERE AlumniID  = @RecordId";

                using (MySqlConnection connection = new MySqlConnection(constring))
                {
                    connection.Open();
                    using (MySqlCommand cmd = new MySqlCommand(updateSql, connection))
                    {
                        try
                        {
                            cmd.Parameters.AddWithValue("@NewValue", newValue);
                            cmd.Parameters.AddWithValue("@RecordId", recordId);
                            cmd.ExecuteNonQuery();
                        }
                        catch (MySqlException ex)
                        {
                            // Handle the exception, e.g., display an error message
                            MessageBox.Show("An error occurred: " + ex.Message);
                        }

                    }
                }
            }
        }

        private void clicks(object sender, EventArgs e)
        {
            string textBoxText = textBox2.Text;
            if (textBoxText == "Enter MemberID")
            {
                textBox2.Text = "";
            }
            else
            {

            }

        }



        private void RefreshDataGridView()
        {
            using (MySqlConnection con = new MySqlConnection(constring))
            {
                con.Open();
                using (MySqlCommand cmd = new MySqlCommand("SELECT AlumniID,FirstName, LastName, MiddleName FROM alumni", con))
                {
                    using (MySqlDataAdapter sda = new MySqlDataAdapter(cmd))
                    {
                        using (DataTable dt = new DataTable())
                        {
                            sda.Fill(dt);
                            dataGridView1.DataSource = dt;

                            dataGridView1.Columns["AlumniID"].ReadOnly = true;
                            dataGridView1.Columns["FirstName"].Width = 200;
                            dataGridView1.Columns["LastName"].Width = 200;
                            dataGridView1.Columns["MiddleName"].Width = 200;
                        }
                    }
                }
                con.Close();
            }
        }
        private void button2_Click(object sender, EventArgs e)
        {
            using (MySqlConnection connection = new MySqlConnection(constring))
            {
                try
                {
                    connection.Open();

                    // Get data from TextBox controls
                    string memberid = textBox2.Text;
                    string firstname, lastname, middlename;

                    // Check if a record with the same MEMBERID exists in the MEMBERS table
                    string checkMemberQuery = "SELECT FirstName, LastName, MiddleName FROM members WHERE MemberID = @MemberID ";

                    using (MySqlCommand checkMemberCmd = new MySqlCommand(checkMemberQuery, connection))
                    {
                        checkMemberCmd.Parameters.AddWithValue("@MemberID", memberid);

                        using (MySqlDataReader reader = checkMemberCmd.ExecuteReader())
                        {
                            if (reader.Read())
                            {
                                firstname = reader.GetString("FirstName");
                                lastname = reader.GetString("LastName");
                                middlename = reader.GetString("MiddleName");
                            }
                            else
                            {
                                MessageBox.Show("No member with the provided MemberID found.");
                                return; // Exit the method if no member is found
                            }
                        }
                    }

                    // Check if a record with the same FirstName, LastName, and MiddleName already exists in the ALUMNI table
                    string checkAlumniQuery = "SELECT COUNT(*) FROM alumni WHERE FirstName = @FirstName AND LastName = @LastName AND MiddleName = @MiddleName";

                    using (MySqlCommand checkAlumniCmd = new MySqlCommand(checkAlumniQuery, connection))
                    {
                        checkAlumniCmd.Parameters.AddWithValue("@FirstName", firstname);
                        checkAlumniCmd.Parameters.AddWithValue("@LastName", lastname);
                        checkAlumniCmd.Parameters.AddWithValue("@MiddleName", middlename);

                        int existingRecords = Convert.ToInt32(checkAlumniCmd.ExecuteScalar());

                        if (existingRecords > 0)
                        {
                            MessageBox.Show("A record with the same FirstName, LastName, and MiddleName already exists in the ALUMNI table.");
                        }
                        else
                        {
                            // Define the SQL insert statement for ALUMNI table
                            string insertAlumniQuery = "INSERT INTO alumni (FirstName, LastName, MiddleName) VALUES (@FirstName, @LastName, @MiddleName)";

                            // Create a MySqlCommand to execute the SQL insert query for ALUMNI table
                            using (MySqlCommand insertAlumniCmd = new MySqlCommand(insertAlumniQuery, connection))
                            {
                                insertAlumniCmd.Parameters.AddWithValue("@FirstName", firstname);
                                insertAlumniCmd.Parameters.AddWithValue("@LastName", lastname);
                                insertAlumniCmd.Parameters.AddWithValue("@MiddleName", middlename);

                                // Execute the insert query for ALUMNI table
                                int rowsAffected = insertAlumniCmd.ExecuteNonQuery();

                                if (rowsAffected > 0)
                                {
                                    // Update the MEMBERS table to indicate the transfer to ALUMNI
                                    string updateMemberQuery = "UPDATE members SET TranstoAlumni = 1 WHERE MemberID = @MemberID";

                                    using (MySqlCommand updateMemberCmd = new MySqlCommand(updateMemberQuery, connection))
                                    {
                                        updateMemberCmd.Parameters.AddWithValue("@MemberID", memberid);
                                        updateMemberCmd.ExecuteNonQuery();
                                    }

                                    MessageBox.Show("Done");
                                    RefreshDataGridView();
                                    textBox2.Text = "Enter MemberID";
                                }
                                else
                                {
                                    MessageBox.Show("Insert in ALUMNI failed. Duplicate Data!");
                                }
                            }
                        }
                    }
                }
                catch (Exception ex)
                {
                    MessageBox.Show("An error occurred: " + ex.Message);
                }
            }
        }


        private void button3_Click(object sender, EventArgs e)
        {
            string searchTerm = textBox5.Text;
            PerformSearch(searchTerm);
        }

        private void PerformSearch(string searchTerm)
        {
            using (MySqlConnection connection = new MySqlConnection(constring))
            {
                try
                {
                    connection.Open();

                    string searchQuery = "SELECT * FROM alumni WHERE FirstName LIKE @SearchTerm OR AlumniID  LIKE @SearchTerm OR LastName LIKE @SearchTerm OR MiddleName LIKE @SearchTerm";

                    using (MySqlCommand cmd = new MySqlCommand(searchQuery, connection))
                    {
                        cmd.Parameters.AddWithValue("@SearchTerm", "%" + searchTerm + "%");

                        using (MySqlDataAdapter adapter = new MySqlDataAdapter(cmd))
                        {
                            DataTable dataTable = new DataTable();
                            adapter.Fill(dataTable);

                            if (dataTable.Rows.Count > 0)
                            {
                                dataGridView1.DataSource = dataTable;
                            }
                            else
                            {
                                dataGridView1.DataSource = null; // Clear the DataGridView
                                MessageBox.Show("No records found for the search term.");
                                RefreshDataGridView();
                            }
                        }
                    }
                }
                catch (Exception ex)
                {
                    MessageBox.Show("An error occurred during the search: " + ex.Message);
                }
            }
        }

        private void textBox5_TextChanged(object sender, EventArgs e)
        {
            if (textBox5.Text == "")
            {
                RefreshDataGridView();
            }
        }

        private void button1_Click(object sender, EventArgs e)
        {
            if (dataGridView1.SelectedRows.Count > 0)
            {
                DialogResult result = MessageBox.Show("Are you sure you want to delete this record?", "Confirmation", MessageBoxButtons.YesNo, MessageBoxIcon.Warning);

                if (result == DialogResult.Yes)
                {
                    int rowIndex = dataGridView1.SelectedRows[0].Index;
                    int idToDelete = (int)dataGridView1.Rows[rowIndex].Cells["AlumniID"].Value;
                    string firstname = dataGridView1.Rows[rowIndex].Cells["FirstName"].Value.ToString();
                    string lastname = dataGridView1.Rows[rowIndex].Cells["LastName"].Value.ToString();
                    string middlename = dataGridView1.Rows[rowIndex].Cells["MiddleName"].Value.ToString();

                    using (MySqlConnection connection = new MySqlConnection(constring))
                    {
                        connection.Open();

                        // Check if the record exists in the MEMBERS table
                        string checkMemberQuery = "SELECT MemberID FROM members WHERE FirstName = @FirstName AND LastName = @LastName AND MiddleName = @MiddleName";
                        using (MySqlCommand checkMemberCmd = new MySqlCommand(checkMemberQuery, connection))
                        {
                            checkMemberCmd.Parameters.AddWithValue("@FirstName", firstname);
                            checkMemberCmd.Parameters.AddWithValue("@LastName", lastname);
                            checkMemberCmd.Parameters.AddWithValue("@MiddleName", middlename);

                            object memberId = checkMemberCmd.ExecuteScalar();

                            if (memberId != null)
                            {
                                // Update the MEMBERS table to set TranstoAlumni to 0
                                string updateMemberQuery = "UPDATE members SET TranstoAlumni = 0 WHERE MemberID = @MemberID";
                                using (MySqlCommand updateMemberCmd = new MySqlCommand(updateMemberQuery, connection))
                                {
                                    updateMemberCmd.Parameters.AddWithValue("@MemberID", memberId);
                                    updateMemberCmd.ExecuteNonQuery();
                                }
                            }
                            else
                            {

                            }
                        }

                        // Delete the record from the ALUMNI table
                        string deleteQuery = "DELETE FROM alumni WHERE AlumniID = @ID";
                        using (MySqlCommand cmd = new MySqlCommand(deleteQuery, connection))
                        {
                            cmd.Parameters.AddWithValue("@ID", idToDelete);
                            int rowsAffected = cmd.ExecuteNonQuery();

                            if (rowsAffected > 0)
                            {
                                MessageBox.Show("Record deleted successfully.");
                                RefreshDataGridView(); // Refresh the DataGridView to reflect the changes.
                            }
                            else
                            {
                                MessageBox.Show("Delete failed.");
                            }
                        }
                    }
                }
            }
            else
            {
                MessageBox.Show("Please select a record to delete.");
            }
        }



        private void textBox5_Click(object sender, EventArgs e)
        {
            string textBoxText = textBox5.Text;
            if (textBoxText == "Search Something")
            {
                textBox5.Text = "";
            }
            else
            {

            }
        }

        private void textBox2_KeyPress(object sender, KeyPressEventArgs e)
        {

            if (e.KeyChar == (char)Keys.Enter)
            {
                using (MySqlConnection connection = new MySqlConnection(constring))
                {
                    try
                    {
                        connection.Open();

                        // Get data from TextBox controls
                        string memberid = textBox2.Text;
                        string firstname, lastname, middlename;

                        // Check if a record with the same MEMBERID exists in the MEMBERS table
                        string checkMemberQuery = "SELECT FirstName, LastName, MiddleName FROM members WHERE MemberID = @MemberID ";

                        using (MySqlCommand checkMemberCmd = new MySqlCommand(checkMemberQuery, connection))
                        {
                            checkMemberCmd.Parameters.AddWithValue("@MemberID", memberid);

                            using (MySqlDataReader reader = checkMemberCmd.ExecuteReader())
                            {
                                if (reader.Read())
                                {
                                    firstname = reader.GetString("FirstName");
                                    lastname = reader.GetString("LastName");
                                    middlename = reader.GetString("MiddleName");
                                }
                                else
                                {
                                    MessageBox.Show("No member with the provided MemberID found.");
                                    return; // Exit the method if no member is found
                                }
                            }
                        }

                        // Check if a record with the same FirstName, LastName, and MiddleName already exists in the ALUMNI table
                        string checkAlumniQuery = "SELECT COUNT(*) FROM alumni WHERE FirstName = @FirstName AND LastName = @LastName AND MiddleName = @MiddleName";

                        using (MySqlCommand checkAlumniCmd = new MySqlCommand(checkAlumniQuery, connection))
                        {
                            checkAlumniCmd.Parameters.AddWithValue("@FirstName", firstname);
                            checkAlumniCmd.Parameters.AddWithValue("@LastName", lastname);
                            checkAlumniCmd.Parameters.AddWithValue("@MiddleName", middlename);

                            int existingRecords = Convert.ToInt32(checkAlumniCmd.ExecuteScalar());

                            if (existingRecords > 0)
                            {
                                MessageBox.Show("A record with the same FirstName, LastName, and MiddleName already exists in the ALUMNI table.");
                            }
                            else
                            {
                                // Define the SQL insert statement for ALUMNI table
                                string insertAlumniQuery = "INSERT INTO alumni (FirstName, LastName, MiddleName) VALUES (@FirstName, @LastName, @MiddleName)";

                                // Create a MySqlCommand to execute the SQL insert query for ALUMNI table
                                using (MySqlCommand insertAlumniCmd = new MySqlCommand(insertAlumniQuery, connection))
                                {
                                    insertAlumniCmd.Parameters.AddWithValue("@FirstName", firstname);
                                    insertAlumniCmd.Parameters.AddWithValue("@LastName", lastname);
                                    insertAlumniCmd.Parameters.AddWithValue("@MiddleName", middlename);

                                    // Execute the insert query for ALUMNI table
                                    int rowsAffected = insertAlumniCmd.ExecuteNonQuery();

                                    if (rowsAffected > 0)
                                    {
                                        // Update the MEMBERS table to indicate the transfer to ALUMNI
                                        string updateMemberQuery = "UPDATE members SET TranstoAlumni = 1 WHERE MemberID = @MemberID";

                                        using (MySqlCommand updateMemberCmd = new MySqlCommand(updateMemberQuery, connection))
                                        {
                                            updateMemberCmd.Parameters.AddWithValue("@MemberID", memberid);
                                            updateMemberCmd.ExecuteNonQuery();
                                        }

                                        MessageBox.Show("Done");
                                        RefreshDataGridView();
                                        textBox2.Text = "Enter MemberID";
                                    }
                                    else
                                    {
                                        MessageBox.Show("Insert in ALUMNI failed. Duplicate Data!");
                                    }
                                }
                            }
                        }
                    }
                    catch (Exception ex)
                    {
                        MessageBox.Show("An error occurred: " + ex.Message);
                    }
                }

            }
        }

        private void textBox5_KeyPress(object sender, KeyPressEventArgs e)
        {
            if (e.KeyChar == (char)Keys.Enter)
            {
                string searchTerm = textBox5.Text;
                PerformSearch(searchTerm);
            }
        }
    }
}
