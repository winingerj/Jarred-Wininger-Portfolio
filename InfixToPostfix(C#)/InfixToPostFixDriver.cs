///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//
//	Project:		Project 3   -Infix to Postfix
//	File Name:		InfixToPostFixDriver.cs
//	Description:	Driver for MainWindow, SpashScreen
//	Course:			CSCI 2210 - Data Structures	
//	Author:			Jarred Wininger, Winingerj@goldmail.etsu.edu
//	Created:		Tuesday, November 3, 2015
//	Copyright:		Jarred Wininger, 2015
//
//
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;
using System.Windows.Forms;

namespace InfixToPostFixProj
{
    /// <summary>
    /// Runs Spash and Main windows
    /// </summary>
    static class InfixToPostFixDriver
    {
        /// <summary>
        /// The main entry point for the application.
        /// </summary>
        [STAThread]
        static void Main ( )
        {
            Application.EnableVisualStyles ( );
            Application.SetCompatibleTextRenderingDefault (false);
            
            Application.Run (new SplashScreen ( ));             //run splash screen 
            Application.Run (new MainBox ( ));                  //run main window
            
        }
    }
}
