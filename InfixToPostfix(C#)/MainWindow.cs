///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//
//	Project:		Project 3   -Infix to Postfix
//	File Name:		MainWindow.cs
//	Description:	Manages events from main window
//	Course:			CSCI 2210 - Data Structures	
//	Author:			Jarred Wininger, Winingerj@goldmail.etsu.edu
//	Created:		Tuesday, November 3, 2015
//	Copyright:		Jarred Wininger, 2015
//
//
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.IO;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;

namespace InfixToPostFixProj
{
    public partial class MainBox : Form
    {
        public MainBox ( )
        {
            InitializeComponent ( );
        }

        private void fileToolStripMenuItem_Click (object sender, EventArgs e)
        {


        }
        
        /// <summary>
        /// When Open File is selected in menu, uses OpenFileDialog to read in file
        /// </summary>
        /// <param name="sender"></param>
        /// <param name="e"></param>
        private void openTextFileMenuItem_Click(object sender, EventArgs e)
        {
            OpenFileDialog dlg = new OpenFileDialog ( );            //create new OpenFileDialog

            dlg.InitialDirectory = Application.StartupPath;
            dlg.Title = "Select A Text File to Analyze";
            dlg.Filter = "text files|*.txt|all files|*.*";

            if (dlg.ShowDialog ( ) == DialogResult.Cancel)
                return;

            StreamReader rdr = null;                            //create new streamreader
            try
            {
                rdr = new StreamReader (dlg.FileName);          //give rdr filename
                //read in lines and store them in ListBox in MainWindow
                while (rdr.Peek() != -1)
                {
                    string infixExpression = rdr.ReadLine ( );                                          //reads line and stores in InfixExpression
                    infixListBox.Items.Add (string.Join (Environment.NewLine, infixExpression));        //add infixexpression to listbox

                }
            }
            catch
            {
                MessageBox.Show ("Error. Could Not Open File.");                                        //if file unable to be opened, display error
            }
            finally
            {
                //if reader was initialized, close it
                if (rdr != null)            
                    rdr.Close ( );
            }

            

        }

        /// <summary>
        /// Closes program when exit selected
        /// </summary>
        /// <param name="sender"></param>
        /// <param name="e"></param>
        private void exitToolStripMenuItem_Click(object sender, EventArgs e)
        {
            this.Close ( );
        }

        /// <summary>
        /// displays about info box
        /// </summary>
        /// <param name="sender"></param>
        /// <param name="e"></param>
        private void aboutInfoMenuItem_Click(object sender, EventArgs e)
        {
            AboutInfixToPostfix about = new AboutInfixToPostfix ( );
            about.Show ( );
            
           
        }

        /// <summary>
        /// generates postfix expression for infix expression currently in infix box
        /// </summary>
        /// <param name="sender"></param>
        /// <param name="e"></param>
        private void GenerateButton_Click (object sender, EventArgs e)
        {
            PostFix pf = new PostFix ( );
            string resultingPostfix;
            string selectedInfix = InfixBox.Text;
            if (!selectedInfix.Equals (null))
            {
                pf.InfixExpression = selectedInfix;
                resultingPostfix = pf.PostfixExpression;

                InfixBox.Text = selectedInfix;
                PostFixBox.Text = resultingPostfix;
            }

        }

        /// <summary>
        /// clears postfixBox and infixBox
        /// </summary>
        /// <param name="sender"></param>
        /// <param name="e"></param>
        private void ClearButton_Click (object sender, EventArgs e)
        {
            InfixBox.Text = String.Empty;
            PostFixBox.Text = String.Empty;
        }

        /// <summary>
        /// closes program
        /// </summary>
        /// <param name="sender"></param>
        /// <param name="e"></param>
        private void ExitButton_Click (object sender, EventArgs e)
        {
            this.Close ( );
        }

        /// <summary>
        /// when new infix expression selected in ListBox, generate postfix expression
        /// </summary>
        /// <param name="sender"></param>
        /// <param name="e"></param>
        private void infixListBox_SelectedIndexChanged (object sender, EventArgs e)
        {
            PostFix pf = new PostFix ( );                                                       //create new postfix object
            string resultingPostfix;                                                            //holds postfix string 
            string selectedInfix = infixListBox.GetItemText (infixListBox.SelectedItem);        //holds infix expression
            //if infix expression is not null, generate postfix
            if (!selectedInfix.Equals (null))
            {
                pf.InfixExpression = selectedInfix;             //passes infix to pf object
                resultingPostfix = pf.PostfixExpression;        //stores created postfix expression

                InfixBox.Text = selectedInfix;                  //displays infix expression
                PostFixBox.Text = resultingPostfix;             //displays postfix expression
            }
        }

        private void MainBox_Load (object sender, EventArgs e)
        {

        }
    }
}
