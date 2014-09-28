import java.awt.*;
import java.awt.event.*;
import javax.swing.*;
import java.sql.*;
import java.awt.event.*;
import java.io.*;
import javax.swing.filechooser.FileNameExtensionFilter;

public class Read extends JPanel implements ActionListener{
	JFrame myFrame;
	JButton chooseFile,confirm;
	JFileChooser fc;
	JTextField filebox;
	JPanel pane;
	
	public static void main (String args[])
	{	
		Read a = new Read();
		a.showFrame();
		 String url = "jdbc:mysql://localhost:3306/"; 
		String dbName = "scry"; 
		String driver = "com.mysql.jdbc.Driver";
		String userName = "root";
		String password = "";
		try { 
			Class.forName(driver).newInstance(); 
			Connection conn = DriverManager.getConnection(url+dbName,userName,password);
		
			conn.close();
		} catch(Exception e)
		{
		} 
	}
	
	public void showFrame()
	{
		myFrame = new JFrame();
		myFrame.setSize(250,125);
		myFrame.setVisible(true);
		myFrame.setLayout(new BorderLayout());
		setUpButtons();
		myFrame.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
	}
	
	public void setUpButtons()
	{
		pane = new JPanel(new FlowLayout());
		chooseFile = new JButton("Browse");
		confirm = new JButton("Create Rows");
		chooseFile.addActionListener(this);
		confirm.addActionListener(this);
		filebox = new JTextField();
		filebox.setEditable(false);
		myFrame.add(filebox, BorderLayout.CENTER);
		pane.add(chooseFile);
		pane.add(confirm);
		myFrame.add(pane, BorderLayout.PAGE_END);
		fc = new JFileChooser();
		FileNameExtensionFilter filter = new FileNameExtensionFilter("Price List", "txt");
		fc.setFileFilter(filter);
	}
	
	public void actionPerformed(ActionEvent ae)
	{
		if(ae.getSource() == confirm)
		{
		//filebox.setText("confirm");
		} else
		{
			int a = fc.showOpenDialog(myFrame);
			if(a == JFileChooser.APPROVE_OPTION)
			{
			File file = fc.getSelectedFile();
			filebox.setText(file.getPath());
			}
		}
	}
	
}