//Aaron Burrell
//U0190774 
//cs5530 Project 2

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.time.LocalDateTime;
import java.util.ArrayList;
import java.util.Scanner;

public class LibrarySystem {

	public static Connection con = null;

	public static void main(String[] args) {
		// System.out.println("Example for CS5530");

		try {
			// remember to replace the password
			String userName = "cs5530u38";
			String password = "pvn1esfd";
			String url = "jdbc:mysql://georgia.eng.utah.edu/cs5530db38";
			Class.forName("com.mysql.jdbc.Driver").newInstance();
			con = DriverManager.getConnection(url, userName, password);
			System.out.println("Connected");
			Statement stmt = con
					.createStatement(ResultSet.TYPE_SCROLL_SENSITIVE,
							ResultSet.CONCUR_UPDATABLE);

			System.out.println("Enter 1 to sign in or 2 to register. ");

			Scanner in = new Scanner(System.in);
			int firstPrompt = in.nextInt();

			if (firstPrompt == 1) {
				login();
			}

			if (firstPrompt == 2) {
				register();
				login();
			}

			// ///// OPTION 2 - USE THIS TECHNIQUE //////

		} catch (Exception e) {
			e.printStackTrace();
			System.err.println("Cannot connect to database server");
		} finally {
			if (con != null) {
				try {
					con.close();
					System.out.println("Database connection terminated");
				} catch (Exception e) { /* ignore close errors */
				}
			}
		}

		System.out.println("DONE");
	}

	private static void login() {
		boolean loggedIn = false;
		String uname = null;
		int cardId = -100;
		// TODO Auto-generated method stub
		System.out.println("Enter your username: ");
		Scanner in2 = new Scanner(System.in);

		String username = in2.nextLine();

		String query_2 = "SELECT * FROM User where userName LIKE ?";
		PreparedStatement query_2_statment = null;
		try {
			query_2_statment = con.prepareStatement(query_2);
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}

		try {
			query_2_statment.setString(1, username);
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
		ResultSet rs2 = null;
		try {
			rs2 = query_2_statment.executeQuery();
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}

		try {
			while (rs2.next()) {
				System.out.print("Welcome Back ");
				System.out.print(rs2.getString("fullName")
						+ "\nyou have admin privalages");
				uname = rs2.getString("userName");
				cardId = rs2.getInt("cardId");
				loggedIn = true;

			}
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}

		while (loggedIn) {
			System.out
					.println("\n\nEnter: \n1 to check out a book, \n2 to Get on a waitlist, \n3 to print User Record,"
							+ " \n4 to add a new Book's Info to Database, \n5 to add book copies to the inventory,"
							+ "\n6 to print late book list, \n7 to review a book, \n8 to browse books, \nto 9 Return Book or Report Lost Book "
							+ " \n10 to Print Book Record \n11 to Print Book Statistics \n12 to Print User Statistics \n13 to log out.");

			int checkOrWait = in2.nextInt();

			if (checkOrWait == 1) {

				checkout(cardId);

			}

			if (checkOrWait == 2) {

				waitList(cardId);

			}

			if (checkOrWait == 3) {

				printUserRecord(cardId);

			}
			if (checkOrWait == 4) {

				addBookInfo();

			}
			if (checkOrWait == 5) {

				addBookCopies();

			}
			if (checkOrWait == 6) {

				printLateList(LocalDateTime.now().plusDays(30));

			}
			if (checkOrWait == 7) {

				reviewBook(cardId);

			}
			if (checkOrWait == 8) {

				browseBooks();

			}
			if (checkOrWait == 9) {
				// return book
				returnBook(cardId);

			}
			if (checkOrWait == 10) {
				// book record
				/*
				 * • All information about the book (ISBN, title, authors, subject(s), etc.) 
				 * • A listing of all the copies tracked by the library and the whereabouts of those copies. 
				 * • A listing of all users who have checked out the book and the dates they
				 * 	 had possession of the book. 
				 * • The average review score for the book, along with the individual reviews for the book.
				 */
				System.out
						.println("\nEnter a book's isbn number you want more info about. (like 139649721-8)");

				Scanner in5 = new Scanner(System.in);

				String isbn = in5.nextLine();

				System.out
						.println("\nEnter\n1 to print All Info on the Book,"
								+ "\n2 to print a list of all copies and location, "
								+ "\n3 to print a list of everyone who has checked out the book or,"
								+ "\n4 to print average review score and all reviews.");

				Scanner in4 = new Scanner(System.in);

				int statOption = in4.nextInt();

				if (statOption == 1) {
					// checkedoutmost
					getAllBookInfo(isbn);
				}
				if (statOption == 2) {
					// ratedtmost
					copiesAndLocations(isbn);
				}
				if (statOption == 3) {
					// lostmost
					getBookCheckOutRecord(isbn);
				}
				if (statOption == 4) {
					// lostmost
					getAvgScoreReviews(isbn);
				}

			}
			if (checkOrWait == 11) {
				/*
				 * The list of the n (say n=10) most checked out books. • The
				 * list of the n most requested books. • The list of the n most
				 * lost books. • The list of the n most popular authors
				 */
				System.out
						.println("\nEnter\n1 to print top n Books that have been checked out the most,"
								+ "\n2 to print top n Books that have been requested the most, "
								+ "\n3 to print top n Books that have been lost,"
								+ "\n4 to print top n Most popular authors.");

				Scanner in4 = new Scanner(System.in);

				int statOption = in4.nextInt();

				if (statOption == 1) {
					// checkedoutmost
					printMostCheckedOutBooks();
				}
				if (statOption == 2) {
					// ratedtmost
					printMostRequestedBooks();
				}
				if (statOption == 3) {
					// lostmost
					printMostLostBooks();
				}
				if (statOption == 4) {
					// lostmost
					printMostPopularAuthors();
				}
			}
			if (checkOrWait == 12) {
				// print user statistics
				System.out
						.println("\nEnter\n1 to print top n users who have checked out the most books,"
								+ "\n2 to print top n users who have rated the most number of books, or"
								+ "\n3 to print top n users who have lost the most books.");

				Scanner in5 = new Scanner(System.in);

				int statOption = in5.nextInt();

				if (statOption == 1) {
					// checkedoutmost
					printCheckedOutMost();
				}
				if (statOption == 2) {
					// ratedtmost
					printRatedMost();
				}
				if (statOption == 3) {
					// lostmost
					printLostMost();
				}
			}
			if (checkOrWait == 13) {

				break;

			}
		}

	}

	private static void getAvgScoreReviews(String isbn) {
		//first get the average score
		String query_2 = "SELECT isbn, avg(score) as average FROM BookReview join Book on Book.bid=BookReview.bid  where isbn = ?";
		PreparedStatement query_2_statment = null;
		try {
			query_2_statment = con.prepareStatement(query_2);

			query_2_statment.setString(1, isbn);
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
		ResultSet rs2 = null;
		try {
			rs2 = query_2_statment.executeQuery();
			System.out.print("The average user rating for: "+isbn);
			while (rs2.next()) {
				
				System.out.print(" is " + rs2.getString("average"));
				
			}
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
		
		String query_3 = "SELECT isbn, score, cardId, opinion FROM BookReview join Book on Book.bid=BookReview.bid  where isbn = ?";
		PreparedStatement query_3_statment = null;
		try {
			query_3_statment = con.prepareStatement(query_3);

			query_3_statment.setString(1, isbn);
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
		 rs2 = null;
		try {
			rs2 = query_3_statment.executeQuery();
			System.out.print("\nIndividual Reviews and Scores for ISBN: " + isbn);
			while (rs2.next()) {
				
				System.out.print("\n\nUser ID: " + rs2.getString("cardId"));
				System.out.print("\nUser's Score: " + rs2.getString("score"));
				System.out.print("\nUser Review: " + rs2.getString("opinion"));
				

			}
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}

		
	}

		
	

	private static void getBookCheckOutRecord(String isbn) {
		String query_2 = "SELECT cardId, isbn, CheckOutDate FROM Book join CheckoutRecord on Book.bid= CheckoutRecord.bid where isbn = ? ;";
		PreparedStatement query_2_statment = null;
		try {
			query_2_statment = con.prepareStatement(query_2);

			query_2_statment.setString(1, isbn);
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
		ResultSet rs2 = null;
		try {
			rs2 = query_2_statment.executeQuery();
			System.out.print("All Users who have checked out and coorisponding check out dates of ISBN: "+isbn);
			while (rs2.next()) {
				System.out.print("\n\nCheck Out Info: ");
				System.out.print("\nUser ID: " + rs2.getString("cardId"));
				System.out.print("\nCheck Out Date: " + rs2.getString("CheckOutDate"));
				

			}
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
		
		
	}

	private static void copiesAndLocations(String isbn) {
		String query_2 = "SELECT * from Book where isbn LIKE ?";
		PreparedStatement query_2_statment = null;
		try {
			query_2_statment = con.prepareStatement(query_2);

			query_2_statment.setString(1, isbn);
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
		ResultSet rs2 = null;
		try {
			rs2 = query_2_statment.executeQuery();
			System.out.print("All Copies and Locations of ISBN: "+isbn);
			while (rs2.next()) {
				System.out.print("\n\nBook Copy Info: ");
				System.out.print("\nBook ID Number: " + rs2.getString("bid"));
				System.out.print("\nLocation: " + rs2.getString("location"));
				

			}
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
		
	}

	private static void getAllBookInfo(String isbn) {
		//first get all authors  test with 139649721-8
		
		String query_2 = "select author from (SELECT author, isbn  FROM Author join Book on Book.bid=Author.bid)a where isbn = ? ;";
		PreparedStatement query_2_statment = null;
		try {
			query_2_statment = con.prepareStatement(query_2);

			query_2_statment.setString(1, isbn);
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
		ResultSet rs2 = null;
		try {
			rs2 = query_2_statment.executeQuery();
			System.out.print("All Authors: ");
			while (rs2.next()) {
				
				System.out.print("\nAuthor Name: " + rs2.getString("author"));
				
			}
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
		
		String query_3 = "SELECT * FROM BookInfo where isbn = ?";
		PreparedStatement query_3_statment = null;
		try {
			query_3_statment = con.prepareStatement(query_3);

			query_3_statment.setString(1, isbn);
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
		 rs2 = null;
		try {
			rs2 = query_3_statment.executeQuery();

			while (rs2.next()) {
				System.out.print("\nISBN: " + isbn);
				System.out.print("\nTitle: " + rs2.getString("title"));
				System.out.print("\nPublisher: " + rs2.getString("publisher"));
				System.out.print("\nSubject: " + rs2.getString("subject"));
				System.out.print("\nYear Published: " + rs2.getString("yearPublished"));
				System.out.print("\nformat: " + rs2.getString("format"));
				System.out.print("\nsummary: " + rs2.getString("summary"));

			}
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}

		
	}

	private static void printMostPopularAuthors() {
		System.out
				.println("\nEnter the number of Popular Authors you want printed ranked top down.");

		Scanner in5 = new Scanner(System.in);

		int printCount = in5.nextInt();

		String query_2 = "Select author ,count(BookWaitList.bid)as authorreserves from (Select author, isbn, Book.bid, title from Book Join Author on Book.bid=Author.bid)a join BookWaitList on a.bid=BookWaitList.bid group by author  ORDER BY authorreserves DESC LIMIT ?";

		PreparedStatement query_2_statment = null;
		try {
			query_2_statment = con.prepareStatement(query_2);

			query_2_statment.setInt(1, printCount);
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
		ResultSet rs2 = null;
		try {
			rs2 = query_2_statment.executeQuery();
			int ranking = 0;
			while (rs2.next()) {
				ranking++;
				System.out.print("\n\nAuthor Info: ");
				System.out.print("\nRanking: " + ranking);
				System.out.print("\nAuthor Name: " + rs2.getString("author"));

				System.out.print("\nNumber of books by "
						+ rs2.getString("author") + " currently reserved: "
						+ rs2.getString("authorreserves"));

			}
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}

	}

	private static void printMostLostBooks() {
		System.out
				.println("\nEnter the number of Books you want printed ranked by most lost from top down.");

		Scanner in5 = new Scanner(System.in);

		int printCount = in5.nextInt();

		String query_2 = "SELECT isbn, title, COUNT(CheckoutRecord.bid) AS lostcount FROM CheckoutRecord Join Book on CheckoutRecord.bid = Book.bid where lostInt = '1' GROUP BY Book.isbn ORDER BY lostcount DESC LIMIT ? ";

		PreparedStatement query_2_statment = null;
		try {
			query_2_statment = con.prepareStatement(query_2);

			query_2_statment.setInt(1, printCount);
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
		ResultSet rs2 = null;
		try {
			rs2 = query_2_statment.executeQuery();
			int ranking = 0;
			while (rs2.next()) {
				ranking++;
				System.out.print("\n\nBook Info: ");
				System.out.print("\nRanking: " + ranking);
				System.out.print("\nISBN: " + rs2.getString("ISBN"));
				System.out.print("\nTitle: " + rs2.getString("Title"));

				System.out.print("\nNumber of times " + rs2.getString("title")
						+ " was lost: " + rs2.getString("lostcount"));

			}
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}

	}

	private static void printMostRequestedBooks() {
		System.out
				.println("\nEnter the number of top Books to print ranked by Requests from top down.");

		Scanner in5 = new Scanner(System.in);

		int printCount = in5.nextInt();

		String query_2 = "SELECT  isbn, title, COUNT(BookWaitList.bid) AS waitlistcount FROM BookWaitList Join Book on BookWaitList.bid = Book.bid  GROUP BY isbn ORDER BY waitlistcount DESC LIMIT ? ";

		PreparedStatement query_2_statment = null;
		try {
			query_2_statment = con.prepareStatement(query_2);

			query_2_statment.setInt(1, printCount);
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
		ResultSet rs2 = null;
		try {
			rs2 = query_2_statment.executeQuery();
			int ranking = 0;
			while (rs2.next()) {
				ranking++;
				System.out.print("\n\nBook Info: ");
				System.out.print("\nRanking: " + ranking);
				System.out.print("\nISBN: " + rs2.getString("isbn"));
				System.out.print("\nTitle: " + rs2.getString("title"));

				System.out.print("\nNumber of times " + rs2.getString("title")
						+ " has been reserved: "
						+ rs2.getString("waitlistcount"));

			}
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}

	}

	private static void printMostCheckedOutBooks() {
		System.out
				.println("\nEnter the number you want printed of top users ranked by check outs from top down.");

		Scanner in5 = new Scanner(System.in);

		int printCount = in5.nextInt();

		String query_2 = "SELECT  isbn, title, COUNT(CheckoutRecord.bid) AS checkoutcount FROM CheckoutRecord Join Book on CheckoutRecord.bid = Book.bid  GROUP BY isbn ORDER BY checkoutcount DESC LIMIT ? ";

		PreparedStatement query_2_statment = null;
		try {
			query_2_statment = con.prepareStatement(query_2);

			query_2_statment.setInt(1, printCount);
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
		ResultSet rs2 = null;
		try {
			rs2 = query_2_statment.executeQuery();
			int ranking = 0;
			while (rs2.next()) {
				ranking++;
				System.out.print("\n\nBook Info: ");
				System.out.print("\nRanking: " + ranking);
				System.out.print("\nISBN: " + rs2.getString("isbn"));
				System.out.print("\nTitle: " + rs2.getString("title"));

				System.out.print("\nNumber of times " + rs2.getString("title")
						+ " has been checked out: "
						+ rs2.getString("checkoutcount"));

			}
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}

	}

	private static void printLostMost() {
		System.out
				.println("\nEnter the number you want printed of top users ranked by lost books from top down.");

		Scanner in5 = new Scanner(System.in);

		int printCount = in5.nextInt();

		String query_2 = "SELECT User.cardId, fullName, COUNT(User.cardId) AS lostcount FROM CheckoutRecord Join User on CheckoutRecord.cardId = User.cardId where lostInt = '1' GROUP BY User.cardId ORDER BY lostcount DESC LIMIT ? ";

		PreparedStatement query_2_statment = null;
		try {
			query_2_statment = con.prepareStatement(query_2);

			query_2_statment.setInt(1, printCount);
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
		ResultSet rs2 = null;
		try {
			rs2 = query_2_statment.executeQuery();
			int ranking = 0;
			while (rs2.next()) {
				ranking++;
				System.out.print("\n\nUser Info: ");
				System.out.print("\nRanking: " + ranking);
				System.out.print("\nCard Id: " + rs2.getString("cardId"));
				System.out.print("\nFull Name: " + rs2.getString("fullName"));

				System.out.print("\nNumber of Books lost by "
						+ rs2.getString("fullName") + " : "
						+ rs2.getString("lostcount"));

			}
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}

	}

	private static void printRatedMost() {

		System.out
				.println("\nEnter the number you want printed of top users ranked by reviews given from top down.");

		Scanner in5 = new Scanner(System.in);

		int printCount = in5.nextInt();

		String query_2 = "SELECT User.cardId, fullName, COUNT(User.cardId) AS reviewcount FROM BookReview Join User on BookReview.cardId = User.cardId GROUP BY User.cardId ORDER BY reviewcount DESC LIMIT ?";

		PreparedStatement query_2_statment = null;
		try {
			query_2_statment = con.prepareStatement(query_2);

			query_2_statment.setInt(1, printCount);
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
		ResultSet rs2 = null;
		try {
			rs2 = query_2_statment.executeQuery();
			int ranking = 0;
			while (rs2.next()) {
				ranking++;
				System.out.print("\n\nUser Info: ");
				System.out.print("\nRanking:" + ranking);

				System.out.print("\nCard Id: " + rs2.getString("cardId"));
				System.out.print("\nFull Name: " + rs2.getString("fullName"));

				System.out.print("\nNumber of Reviws Given by "
						+ rs2.getString("fullName") + " : "
						+ rs2.getString("reviewcount"));

			}
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}

	}

	private static void printCheckedOutMost() {
		System.out
				.println("\nEnter the number you want printed of top users ranked by check outs from top down.");

		Scanner in5 = new Scanner(System.in);

		int printCount = in5.nextInt();

		String query_2 = "SELECT User.cardId, fullName, COUNT(User.cardId) AS checkoutcount FROM CheckoutRecord Join User on CheckoutRecord.cardId = User.cardId GROUP BY User.cardId ORDER BY checkoutcount DESC LIMIT ? ";

		PreparedStatement query_2_statment = null;
		try {
			query_2_statment = con.prepareStatement(query_2);

			query_2_statment.setInt(1, printCount);
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
		ResultSet rs2 = null;
		try {
			rs2 = query_2_statment.executeQuery();
			int ranking = 0;
			while (rs2.next()) {
				ranking++;
				System.out.print("\n\nUser Info: ");
				System.out.print("\nRanking: " + ranking);
				System.out.print("\nCard Id: " + rs2.getString("cardId"));
				System.out.print("\nFull Name: " + rs2.getString("fullName"));

				System.out.print("\nNumber of Books Ever Checked Out by "
						+ rs2.getString("fullName") + " : "
						+ rs2.getString("lostcount"));

			}
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}

	}

	private static void returnBook(int cardId) {
		System.out
				.println("\nEnter\n1 to return book or\n2 to report book lost: ");

		Scanner in2 = new Scanner(System.in);

		int isLost = in2.nextInt();

		System.out.println("\nEnter the book's ID : ");

		Scanner in3 = new Scanner(System.in);

		int bid = in3.nextInt();

		if (isLost == 1) {
			String updateTableSql = "Update CheckoutRecord set checkInDate = CURRENT_TIMESTAMP where cardId LIKE ? and bid LIKE ? ;";

			// create the mysql insert preparedstatement
			PreparedStatement preparedStatement;
			try {
				preparedStatement = con.prepareStatement(updateTableSql);

				preparedStatement.setInt(1, cardId);
				preparedStatement.setInt(2, bid);
				preparedStatement.executeUpdate();

			} catch (SQLException e) {
				// TODO Auto-generated catch block
				e.printStackTrace();
			}

			updateTableSql = "UPDATE Book SET available = ? WHERE bid = ? ;";
			// create the mysql insert preparedstatement
			// PreparedStatement preparedStatement;
			try {
				preparedStatement = con.prepareStatement(updateTableSql);

				preparedStatement.setInt(1, 1);
				preparedStatement.setInt(2, bid);
				preparedStatement.executeUpdate();

			} catch (SQLException e) {
				// TODO Auto-generated catch block
				e.printStackTrace();
			}

			System.out.println("\nBook Id " + bid + " Has been retuned: ");

			String query_2 = "SELECT * FROM BookWaitList where bid LIKE ?";
			PreparedStatement query_2_statment = null;
			try {
				query_2_statment = con.prepareStatement(query_2);

				query_2_statment.setInt(1, bid);
			} catch (SQLException e) {
				// TODO Auto-generated catch block
				e.printStackTrace();
			}
			ResultSet rs2 = null;
			try {
				rs2 = query_2_statment.executeQuery();
				System.out
						.print(" Card Ids of any people reserving this book are below: ");
				while (rs2.next()) {

					System.out.print("\n\nCard Id: " + rs2.getString("cardId"));
					System.out.print("\nDate reservation was made: "
							+ rs2.getString("dateAdded"));

				}
			} catch (SQLException e) {
				// TODO Auto-generated catch block
				e.printStackTrace();
			}

		}

		if (isLost == 2) {
			String updateTableSql = "Update CheckoutRecord set lostDate = CURRENT_TIMESTAMP where cardId LIKE ? and bid LIKE ? ;";

			// create the mysql insert preparedstatement
			PreparedStatement preparedStatement;
			try {
				preparedStatement = con.prepareStatement(updateTableSql);

				preparedStatement.setInt(1, cardId);
				preparedStatement.setInt(2, bid);
				preparedStatement.executeUpdate();

			} catch (SQLException e) {
				// TODO Auto-generated catch block
				e.printStackTrace();
			}

			updateTableSql = "Update CheckoutRecord set lostInt = ? where cardId = ? and bid = ? ;";
			;
			// create the mysql insert preparedstatement
			// PreparedStatement preparedStatement;
			try {
				preparedStatement = con.prepareStatement(updateTableSql);

				preparedStatement.setInt(1, 1);
				preparedStatement.setInt(2, cardId);
				preparedStatement.setInt(3, bid);
				preparedStatement.executeUpdate();

			} catch (SQLException e) {
				// TODO Auto-generated catch block
				e.printStackTrace();
			}

			System.out.println("\nBook Id " + bid
					+ " Has been reported lost...oh boy!: ");
		}

	}

	private static void browseBooks() {

		System.out
				.println("\nYou may search Library by Author, Publisher, title-words, or subject. Or some combo of the 4. ");

		Scanner in = new Scanner(System.in);
		boolean compiling = true;
		boolean addOr = false;
		boolean addAnd = false;

		String queryString = "Select distinct isbn, title, subject, publisher, yearPublished from (Select Book.bid, isbn, title, author, subject, publisher, yearPublished from Book JOIN Author on Book.bid = Author.bid)x  where ";

		while (compiling) {
			System.out
					.println("\nEnter \n1 to add author,\n2 to add Publisher,\n3 to add title-words,"
							+ "\n4 to add subject,\n5 to add an 'and' next in your search\n"
							+ "6 to add an 'or' next in your search \n7 to compile and run search");
			Scanner in2 = new Scanner(System.in);
			int compileOption = in2.nextInt();

			if (compileOption == 1) {
				queryString += " x.author=";
				Scanner in3 = new Scanner(System.in);
				System.out.println("\nEnter Author's Name");
				queryString += "'" + in3.nextLine() + "' ";

			}

			if (compileOption == 2) {

				queryString += " x.publisher= ";
				Scanner in4 = new Scanner(System.in);
				System.out.println("\nEnter Publisher");
				queryString += "'" + in4.nextLine() + "' ";
			}

			if (compileOption == 3) {
				// title-words

				queryString += " x.title LIKE ";
				Scanner in5 = new Scanner(System.in);
				System.out.println("\nEnter title-key word(s)");
				queryString += "'%" + in5.nextLine() + "'% ";

			}
			if (compileOption == 4) {
				// subject
				queryString += " x.subject= ";
				Scanner in5 = new Scanner(System.in);
				System.out.println("\nEnter Subject");
				queryString += "'" + in5.nextLine() + "' ";

			}
			if (compileOption == 5) {

				queryString += "and";

			}
			if (compileOption == 6) {

				queryString += "or";

			}
			if (compileOption == 7) {
				compiling = false;
				System.out.println(queryString);

				String query_2 = queryString;
				PreparedStatement query_2_statment = null;
				try {
					query_2_statment = con.prepareStatement(query_2);
				} catch (SQLException e) {
					// TODO Auto-generated catch block
					e.printStackTrace();
				}

				ResultSet rs2 = null;
				try {
					rs2 = query_2_statment.executeQuery();
				} catch (SQLException e) {
					// TODO Auto-generated catch block
					e.printStackTrace();
				}

				Scanner in6 = new Scanner(System.in);
				System.out
						.println("\nEnter: \n1 to return all book results or "
								+ "\n2 to return only books available for checkout. ");
				int returnOptionCheckOut = in6.nextInt();

				Scanner in7 = new Scanner(System.in);
				System.out
						.println("\nEnter: \n1 to Sort by Newest Publishing Year First "
								+ "\n2 to sort by highest average user review score first,"
								+ "\n3 to sort by most popular first,"
								+ "\n to not sort. ");
				int returnSortOption = in7.nextInt();

				// rs2 = getAvailableBooks(rs2);
				if (returnSortOption == 2) {
					rs2 = getSortedByScore(queryString, returnOptionCheckOut);
				}

				if (returnSortOption == 1) {
					rs2 = getSortedByYear(queryString, returnOptionCheckOut);

				}

				if (returnSortOption == 3) {
					rs2 = getSortedByPopularity(queryString,
							returnOptionCheckOut);

				}

				// if(returnOptionCheckOut==2){
				// //only available books
				// if(returnSortOption==2){
				// rs2=getSortedByScore(queryString);
				// }
				//
				// if(returnSortOption==1){
				// rs2=getSortedByYear(rs2);
				// }
				//
				// if(returnSortOption==3){
				// rs2=getSortedByPopularity(rs2);
				// }
				//
				// }

				// finally after filtering through all options print result set
				// rs2.
				// try {
				// while (rs2.next()) {
				// System.out.print("\n ");
				// //System.out.print("\nBook ID: " + rs2.getString("bid"));
				// System.out.print("\nISBN: " + rs2.getString("isbn"));
				// System.out.print("\nTitle: " + rs2.getString("title"));
				// //System.out.print("\nAuthor: " + rs2.getString("author"));
				// System.out.print("\nSubject: " + rs2.getString("subject"));
				// System.out.print("\nPublisher: " +
				// rs2.getString("publisher"));
				//
				// // do more function calls
				//
				//
				//
				// }
				// } catch (SQLException e) {
				// // TODO Auto-generated catch block
				// e.printStackTrace();
				// }

			}

		}

	}

	private static ResultSet getSortedByPopularity(String queryString,
			int returnOptionCheckOut) {
		// need to pass along the query
		String bigQeury = " Select checks.isbn, checkedOutCount, title from (SELECT isbn, count(CheckOutDate) checkedOutCount FROM CheckoutRecord Join  Book on Book.bid=CheckoutRecord.bid group by isbn) checks join ("
				+ queryString
				+ ") coreQuery on coreQuery.isbn = checks.isbn order by checkedOutCount DESC;";
		// Select distinct isbn, title, subject, publisher, yearPublished from
		// (Select Book.bid, isbn, title, author, subject, publisher,
		// yearPublished from Book JOIN Author on Book.bid = Author.bid)x where
		// x.subject= 'scifi'

		String query_2 = bigQeury;
		PreparedStatement query_2_statment = null;
		try {
			query_2_statment = con.prepareStatement(query_2);
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}

		ResultSet rs2 = null;
		try {
			rs2 = query_2_statment.executeQuery();
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}

		try {
			if (returnOptionCheckOut == 1) {
				while (rs2.next()) {
					System.out.print("\n ");
					// System.out.print("\nBook ID: " + rs2.getString("bid"));
					System.out.print("\nISBN: " + rs2.getString("isbn"));
					System.out.print("\nTitle: " + rs2.getString("title"));
					System.out.print("\nTimes Checked Out: "
							+ rs2.getString("checkedOutCount"));
					// System.out.print("\nSubject: " +
					// rs2.getString("subject"));
					// System.out.print("\nPublisher: " +
					// rs2.getString("publisher"));

					// do more function calls
				}

			}
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}

		String query_3 = bigQeury;
		PreparedStatement query_3_statment = null;
		try {
			query_3_statment = con.prepareStatement(query_3);
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}

		ResultSet rs3 = null;
		try {
			rs3 = query_3_statment.executeQuery();
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
		try {
			int results = 0;
			if (returnOptionCheckOut == 2) {
				while (rs3.next()) {

					String returnedIsbn = rs3.getString("isbn");
					int available = isAvailable(returnedIsbn);

					if (available > 0) {
						System.out.print("\n ");
						// System.out.print("\nBook ID: " +
						// rs2.getString("bid"));
						System.out.print("\nISBN: " + returnedIsbn);
						System.out.print("\nTitle: " + rs3.getString("title"));
						System.out.print("\nTimes Checked Out: "
								+ rs3.getString("checkedOutCount"));
						// System.out.print("\nSubject: " +
						// rs2.getString("subject"));
						// System.out.print("\nPublisher: " +
						// rs2.getString("publisher"));
						// results ++;
					}

				}
				// System.out.print("results " +results);

			}
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}

		// distinct isbn, title, subject, publisher
		return null;
	}

	private static ResultSet getSortedByYear(String queryString,
			int returnOptionCheckOut) {
		// need to pass along the query
		String bigQeury = "select isbn, yearPublished, title from (select resultSet2.bid, isbn, score, title,  yearPublished from (Select Book.bid, Book.isbn, Book.title, Book.yearPublished from ("
				+ queryString
				+ ")resultSet  join Book on Book.isbn = resultSet.isbn) resultSet2 join BookReview on BookReview.bid = resultSet2.bid) resultSet3 group by isbn ORDER BY yearPublished DESC ;";

		String query_2 = bigQeury;
		PreparedStatement query_2_statment = null;
		try {
			query_2_statment = con.prepareStatement(query_2);
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}

		ResultSet rs2 = null;
		try {
			rs2 = query_2_statment.executeQuery();
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}

		try {
			if (returnOptionCheckOut == 1) {
				while (rs2.next()) {
					System.out.print("\n ");
					// System.out.print("\nBook ID: " + rs2.getString("bid"));
					System.out.print("\nISBN: " + rs2.getString("isbn"));
					System.out.print("\nTitle: " + rs2.getString("title"));
					System.out.print("\nYear Published: "
							+ rs2.getString("yearPublished"));
					// System.out.print("\nSubject: " +
					// rs2.getString("subject"));
					// System.out.print("\nPublisher: " +
					// rs2.getString("publisher"));

					// do more function calls
				}

			}
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}

		String query_3 = bigQeury;
		PreparedStatement query_3_statment = null;
		try {
			query_3_statment = con.prepareStatement(query_3);
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}

		ResultSet rs3 = null;
		try {
			rs3 = query_3_statment.executeQuery();
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
		try {
			int results = 0;
			if (returnOptionCheckOut == 2) {
				while (rs3.next()) {

					String returnedIsbn = rs3.getString("isbn");
					int available = isAvailable(returnedIsbn);

					if (available > 0) {
						System.out.print("\n ");
						// System.out.print("\nBook ID: " +
						// rs2.getString("bid"));
						System.out.print("\nISBN: " + returnedIsbn);
						System.out.print("\nTitle: " + rs3.getString("title"));
						System.out.print("\nYear Published: "
								+ rs3.getString("yearPublished"));
						// System.out.print("\nSubject: " +
						// rs2.getString("subject"));
						// System.out.print("\nPublisher: " +
						// rs2.getString("publisher"));
						// results ++;
					}

				}
				// System.out.print("results " +results);

			}
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}

		// distinct isbn, title, subject, publisher
		return null;
	}

	private static ResultSet getSortedByScore(String queryString,
			int returnOptionCheckOut) {
		// need to pass along the query
		String bigQeury = "select isbn, avg(score) average, title from (select resultSet2.bid, isbn, score, title from (Select Book.bid, Book.isbn, Book.title from ("
				+ queryString
				+ ")resultSet  join Book on Book.isbn = resultSet.isbn) resultSet2 join BookReview on BookReview.bid = resultSet2.bid) resultSet3 group by isbn ORDER BY average DESC ;";

		String query_2 = bigQeury;
		PreparedStatement query_2_statment = null;
		try {
			query_2_statment = con.prepareStatement(query_2);
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}

		ResultSet rs2 = null;
		try {
			rs2 = query_2_statment.executeQuery();
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}

		try {
			if (returnOptionCheckOut == 1) {
				while (rs2.next()) {
					System.out.print("\n ");
					// System.out.print("\nBook ID: " + rs2.getString("bid"));
					System.out.print("\nISBN: " + rs2.getString("isbn"));
					System.out.print("\nTitle: " + rs2.getString("title"));
					System.out.print("\nAverage Score: "
							+ rs2.getString("average"));
					// System.out.print("\nSubject: " +
					// rs2.getString("subject"));
					// System.out.print("\nPublisher: " +
					// rs2.getString("publisher"));

					// do more function calls
				}

			}
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}

		String query_3 = bigQeury;
		PreparedStatement query_3_statment = null;
		try {
			query_3_statment = con.prepareStatement(query_3);
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}

		ResultSet rs3 = null;
		try {
			rs3 = query_3_statment.executeQuery();
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
		try {
			int results = 0;
			if (returnOptionCheckOut == 2) {
				while (rs3.next()) {

					String returnedIsbn = rs3.getString("isbn");
					int available = isAvailable(returnedIsbn);

					if (available > 0) {
						System.out.print("\n ");
						// System.out.print("\nBook ID: " +
						// rs2.getString("bid"));
						System.out.print("\nISBN: " + returnedIsbn);
						System.out.print("\nTitle: " + rs3.getString("title"));
						System.out.print("\nAverage Score: "
								+ rs3.getString("average"));
						// System.out.print("\nSubject: " +
						// rs2.getString("subject"));
						// System.out.print("\nPublisher: " +
						// rs2.getString("publisher"));
						// results ++;
					}

				}
				// System.out.print("results " +results);

			}
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}

		// distinct isbn, title, subject, publisher
		return null;
	}

	private static int isAvailable(String isbn) {

		int result = -100;
		String query_2 = "Select count(bid) as copies from (SELECT * FROM cs5530db38.Book where isbn LIKE ? and available ='1')x;";
		PreparedStatement query_2_statment = null;
		try {
			query_2_statment = con.prepareStatement(query_2);
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}

		try {
			query_2_statment.setString(1, isbn);
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}

		ResultSet rs2 = null;
		try {
			rs2 = query_2_statment.executeQuery();
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}

		try {

			while (rs2.next()) {

				result = rs2.getInt("copies");
				// System.out.print("\n ");
				// System.out.print("\nBook ID: " + rs2.getString("bid"));
				// System.out.print("\nISBN: " + rs2.getString("isbn"));
				// System.out.print("\nTitle: " + rs2.getString("title"));
				// System.out.print("\nAverage Score: " +
				// rs2.getString("average"));
				// System.out.print("\nSubject: " + rs2.getString("subject"));
				// System.out.print("\nPublisher: " +
				// rs2.getString("publisher"));

				// do more function calls

				return result;

			}
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}

		return result;
		// TODO Auto-generated method stub

	}

	private static ResultSet getAvailableBooks(ResultSet rs2) {
		// distinct isbn, title, subject, publisher
		return rs2;
	}

	private static void reviewBook(int cardId) {
		System.out.println("\nEnter a book id you want to review: ");
		Scanner in = new Scanner(System.in);
		String review = "";
		int bid = in.nextInt();

		System.out
				.println("\nEnter a score from 1-10 1 being bad 10 being good: ");
		int score = in.nextInt();

		System.out.println("\nEnter a short review or hit enter to skip: ");
		Scanner in2 = new Scanner(System.in);
		review += in2.nextLine();

		System.out.println("\nUser ID: " + cardId + " gave book id: " + bid
				+ " a score of " + score + "\nWritten Review:\n" + review);

		String query_3 = "INSERT INTO `cs5530db38`.`BookReview` (`cardId`, `bid`, `score`, `opinion`)"
				+ " values (?, ?, ?, ?)";

		try {
			// create the mysql insert preparedstatement
			PreparedStatement preparedStmt = con.prepareStatement(query_3);
			preparedStmt.setInt(1, cardId);
			preparedStmt.setInt(2, bid);
			preparedStmt.setInt(3, score);
			preparedStmt.setString(4, review);

			// execute the preparedstatement
			preparedStmt.execute();

		} catch (SQLException e) {

			e.printStackTrace();
		}

	}

	private static void printLateList(LocalDateTime now) {
		// SELECT * FROM cs5530db38.CheckoutRecord where checkInDate= '0' and
		// dueDate < now() - INTERVAL 30 DAY ;
		System.out
				.print("\nAs of today's date the books that are overdue are: ");

		String query_CO = "SELECT * FROM cs5530db38.CheckoutRecord where checkInDate= '0' and dueDate < now() ";
		PreparedStatement query_CO_statment = null;
		try {
			query_CO_statment = con.prepareStatement(query_CO);
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}

		ResultSet rs2 = null;
		try {
			rs2 = query_CO_statment.executeQuery();
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}

		try {
			while (rs2.next()) {

				int bid = rs2.getInt("bid");
				String dueDate = rs2.getString("dueDate");

				int cardId = rs2.getInt("cardId");
				System.out.println("\n \nBook Id: " + bid
						+ " the Due Date was: " + dueDate);

				String query_3 = "SELECT * FROM User where cardId LIKE ?";
				PreparedStatement query_3_statment = null;
				try {
					query_3_statment = con.prepareStatement(query_3);
				} catch (SQLException e) {
					// TODO Auto-generated catch block
					e.printStackTrace();
				}

				try {
					query_3_statment.setInt(1, cardId);
				} catch (SQLException e) {
					// TODO Auto-generated catch block
					e.printStackTrace();
				}
				ResultSet rs3 = null;
				try {
					rs3 = query_3_statment.executeQuery();
				} catch (SQLException e) {
					// TODO Auto-generated catch block
					e.printStackTrace();
				}

				try {
					while (rs3.next()) {
						System.out.print("User Info: ");

						System.out.print("\nUser's Name: "
								+ rs3.getString("fullName"));

						System.out.print("\nUser's Phone Number: "
								+ rs3.getString("phone"));
						System.out.print("\nUser's Email Address: "
								+ rs3.getString("email"));

					}
				} catch (SQLException e) {
					// TODO Auto-generated catch block
					e.printStackTrace();
				}

			}
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}

	}

	private static void addBookCopies() {

		System.out.print("\nEnter new Book Copy's ISBN: ");
		Scanner namescan = new Scanner(System.in);
		String isbn = namescan.nextLine();
		String title = null;
		String publisher = null;
		String subject = null;
		String yearPublished = null;
		String format = null;
		String summary = null;

		String query_2 = "SELECT * from BookInfo where isbn LIKE ?";
		PreparedStatement query_2_statment = null;
		try {
			query_2_statment = con.prepareStatement(query_2);
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}

		try {
			query_2_statment.setString(1, isbn);
		} catch (SQLException e) {

			e.printStackTrace();
		}
		ResultSet rs2 = null;
		try {
			rs2 = query_2_statment.executeQuery();
		} catch (SQLException e) {

			e.printStackTrace();
		}

		try {
			while (rs2.next()) {
				System.out.print("That book's title should be: ");
				System.out.print(rs2.getString("title"));

				title = rs2.getString("title");
				publisher = rs2.getString("publisher");
				subject = rs2.getString("subject");
				yearPublished = rs2.getString("yearPublished");
				format = rs2.getString("format");
				summary = rs2.getString("summary");
				// System.out.print(publisher+subject+yearPublished+format+summary);
			}
		} catch (SQLException e) {

			e.printStackTrace();
		}

		System.out.print("\nEnter number of copies to add to the inventory: ");
		namescan = new Scanner(System.in);
		int copies = namescan.nextInt();
		System.out.print("\nAdding: " + copies + " copies of " + title);

		for (int i = 0; i < copies; i++) {

			String query_3 = "INSERT INTO `cs5530db38`.`Book` (`isbn`, `title`, `publisher`, `subject`, `format`, `yearPublished`, `summary`, `location`, `available`)"
					+ " values (?, ?, ?, ?, ?, ?, ?, ?, ?)";

			try {
				// create the mysql insert preparedstatement
				PreparedStatement preparedStmt = con.prepareStatement(query_3);
				preparedStmt.setString(1, isbn);
				preparedStmt.setString(2, title);
				preparedStmt.setString(3, publisher);
				preparedStmt.setString(4, subject);
				preparedStmt.setString(5, format);
				preparedStmt.setString(6, yearPublished);
				preparedStmt.setString(7, summary);
				preparedStmt.setString(8, "Library");
				preparedStmt.setInt(9, 1);

				// execute the preparedstatement
				preparedStmt.execute();

			} catch (SQLException e) {

				e.printStackTrace();
			}

		}

	}

	private static void addBookInfo() {

		System.out.print("\nEnter new Book's ISBN: ");
		Scanner namescan = new Scanner(System.in);

		String Isbn = namescan.nextLine();
		System.out.print("\nYou Entered: " + Isbn);

		System.out.print("\nEnter new Book's Title: ");
		String title = namescan.nextLine();
		System.out.print("\nYou Entered: " + title);

		System.out.print("\nEnter new Book's Publisher: ");
		String publisher = namescan.nextLine();
		System.out.print("\nYou Entered: " + publisher);

		System.out.print("\nEnter new Book's Subject: ");
		String subject = namescan.nextLine();
		System.out.print("\nYou Entered: " + subject);

		System.out.print("\nEnter new Book's Year Published: ");
		String year = namescan.nextLine();
		System.out.print("\nYou Entered: " + year);

		System.out.print("\nEnter new Book's Format: ");
		String format = namescan.nextLine();
		System.out.print("\nYou Entered: " + format);

		System.out.print("\nEnter new Book's Summary: ");
		String summary = namescan.nextLine();
		System.out.print("\nYou Entered: " + summary);

		String query_3 = "INSERT INTO `cs5530db38`.`BookInfo` (`isbn`, `title`, `publisher`, `subject`, `format`, `yearPublished`, `summary`)"
				+ " values (?, ?, ?, ?, ?, ?, ?)";

		try {
			// create the mysql insert preparedstatement
			PreparedStatement preparedStmt = con.prepareStatement(query_3);
			preparedStmt.setString(1, Isbn);
			preparedStmt.setString(2, title);
			preparedStmt.setString(3, publisher);
			preparedStmt.setString(4, subject);
			preparedStmt.setString(5, format);
			preparedStmt.setString(6, year);
			preparedStmt.setString(7, summary);

			// execute the preparedstatement
			preparedStmt.execute();

		} catch (SQLException e) {

			e.printStackTrace();
		}

		// TODO Auto-generated method stub

	}

	private static void printUserRecord(int cardId) {
		// TODO Auto-generated method stub

		String query_2 = "SELECT * FROM User where cardId LIKE ?";
		PreparedStatement query_2_statment = null;
		try {
			query_2_statment = con.prepareStatement(query_2);

			query_2_statment.setInt(1, cardId);
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
		ResultSet rs2 = null;
		try {
			rs2 = query_2_statment.executeQuery();

			while (rs2.next()) {
				System.out.print("User Info: ");
				System.out.print("\nUser Name: " + rs2.getString("userName"));
				System.out.print("\nCard Id: " + rs2.getString("cardId"));
				System.out.print("\nFull Name: " + rs2.getString("fullName"));
				System.out.print("\nAddress: " + rs2.getString("address"));
				System.out.print("\nPhone Number: " + rs2.getString("phone"));
				System.out.print("\nEmail Address: " + rs2.getString("email"));

			}
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}

		int bid = -1;
		String allReviews = "";

		query_2 = "SELECT * FROM CheckoutRecord where cardId LIKE ?";
		query_2_statment = null;
		try {
			query_2_statment = con.prepareStatement(query_2);
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}

		try {
			query_2_statment.setString(1, "%" + cardId + "%");
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
		rs2 = null;
		try {
			rs2 = query_2_statment.executeQuery();
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}

		try {
			// Create new ArrayList.
			ArrayList<Integer> Books = new ArrayList<>();
			System.out.print("\n\nCheckout Record: ");
			while (rs2.next()) {

				// print book id
				System.out.print("\n\nBook Id: " + rs2.getString("bid"));
				bid = rs2.getInt("bid");

				// prepare and add to book review list
				String query_4 = "SELECT * FROM BookReview where bid LIKE ? and cardId LIKE ?";
				PreparedStatement query_4_statment = null;
				try {
					query_4_statment = con.prepareStatement(query_4);
				} catch (SQLException e) {
					// TODO Auto-generated catch block
					e.printStackTrace();
				}

				try {
					query_4_statment.setInt(1, bid);
				} catch (SQLException e) {
					// TODO Auto-generated catch block
					e.printStackTrace();
				}
				try {
					query_4_statment.setInt(2, cardId);
				} catch (SQLException e) {
					// TODO Auto-generated catch block
					e.printStackTrace();
				}
				ResultSet rs4 = null;
				try {
					rs4 = query_4_statment.executeQuery();
				} catch (SQLException e) {
					// TODO Auto-generated catch block
					e.printStackTrace();
				}

				try {
					while (rs4.next()) {

						allReviews += "\nYou gave the book number " + bid
								+ " a score of " + rs4.getString("score");
						allReviews += "\nWith Review Comments: "
								+ rs4.getString("opinion") + "\n";

					}
				} catch (SQLException e) {
					// TODO Auto-generated catch block
					e.printStackTrace();
				}

				System.out.print("\nCheck Out Date: "
						+ rs2.getString("checkOutDate"));
				// System.out.print("\nLost Date: "+rs2.getString("lostDate"));
				int lost = rs2.getInt("lostInt");
				System.out.print(lost);
				if (lost == (1)) {
					System.out.print("\nBook number" + bid
							+ " was reported lost.");
					Books.add(bid);
				} else {
					System.out.print("\nCheck In Date: "
							+ rs2.getString("checkInDate"));
				}
				String query_3 = "SELECT * FROM Book where bid LIKE ?";
				PreparedStatement query_3_statment = null;
				try {
					query_3_statment = con.prepareStatement(query_3);
				} catch (SQLException e) {
					// TODO Auto-generated catch block
					e.printStackTrace();
				}

				try {
					query_3_statment.setInt(1, bid);
				} catch (SQLException e) {
					// TODO Auto-generated catch block
					e.printStackTrace();
				}
				ResultSet rs3 = null;
				try {
					rs3 = query_3_statment.executeQuery();
				} catch (SQLException e) {
					// TODO Auto-generated catch block
					e.printStackTrace();
				}

				try {
					while (rs3.next()) {

						System.out.print("\nBook Title: "
								+ rs3.getString("title"));
						System.out.print("\nBook ISBN: "
								+ rs3.getString("isbn"));

					}
				} catch (SQLException e) {
					// TODO Auto-generated catch block
					e.printStackTrace();
				}

			}
			System.out.print("\n\nThe following books were lost.");
			// Loop through Books.
			for (int i = 0; i < Books.size(); i++) {
				int value = Books.get(i);
				System.out.println("\nBook Id: " + value);
			}

			System.out.print("\n\nThe following books are requested:");
			ArrayList<Integer> requests = new ArrayList<>();
			query_2 = "SELECT * FROM BookWaitList where cardId LIKE ?";
			query_2_statment = null;
			try {
				query_2_statment = con.prepareStatement(query_2);
			} catch (SQLException e) {
				// TODO Auto-generated catch block
				e.printStackTrace();
			}

			try {
				query_2_statment.setInt(1, cardId);
			} catch (SQLException e) {
				// TODO Auto-generated catch block
				e.printStackTrace();
			}
			rs2 = null;
			try {
				rs2 = query_2_statment.executeQuery();
			} catch (SQLException e) {
				// TODO Auto-generated catch block
				e.printStackTrace();
			}

			try {
				while (rs2.next()) {
					requests.add(+rs2.getInt("bid"));

				}
			} catch (SQLException e) {
				// TODO Auto-generated catch block
				e.printStackTrace();
			}

			// Loop through Books.
			for (int i = 0; i < requests.size(); i++) {
				int value = requests.get(i);
				System.out.println("\nBook Id: " + value);
			}

		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}

		System.out.print("\n\nBook Reviews:");
		System.out.print(allReviews);

	}

	private static void waitList(int cardId) {
		int bid = -1;
		int waiting = -1;
		System.out.println("\nEnter a book id you want to Reserve: ");
		Scanner in = new Scanner(System.in);

		bid = in.nextInt();

		String query_CO = "SELECT Count(*) as waiting FROM BookWaitList where bid LIKE ? ";
		PreparedStatement query_CO_statment = null;
		try {
			query_CO_statment = con.prepareStatement(query_CO);
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}

		try {
			query_CO_statment.setInt(1, bid);
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
		ResultSet rs2 = null;
		try {
			rs2 = query_CO_statment.executeQuery();
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}

		try {
			while (rs2.next()) {

				waiting = rs2.getInt("waiting");
				// cardId = rs2.getInt("cardId");
				System.out
						.println("\nThe number of reservations ahead of you is: ");
				System.out.print(waiting);

			}
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}

		String query_3 = "INSERT INTO `BookWaitList` (`bid`, `cardId`)"
				+ " values (?, ? )";
		// create the mysql insert preparedstatement
		PreparedStatement preparedStmt = null;
		try {
			preparedStmt = con.prepareStatement(query_3);
		} catch (SQLException e1) {
			// TODO Auto-generated catch block
			e1.printStackTrace();
		}
		try {
			preparedStmt.setInt(1, bid);
		} catch (SQLException e1) {
			// TODO Auto-generated catch block
			e1.printStackTrace();
		}
		try {
			preparedStmt.setInt(2, cardId);
		} catch (SQLException e1) {
			// TODO Auto-generated catch block
			e1.printStackTrace();
		}

		try {
			// execute the preparedstatement
			preparedStmt.execute();

		} catch (SQLException e) {

			e.printStackTrace();
		}

		System.out.println("\nYou have successfully reserved book " + bid);

		String query_5 = "UPDATE `Book` SET `available`= `0` WHERE `bid`LIKE ? ;"; // sets
																					// book's
																					// availability
																					// to
																					// 0
		// create the mysql insert preparedstatement
		PreparedStatement preparedStmt5 = null;
		try {
			preparedStmt5 = con.prepareStatement(query_5);
		} catch (SQLException e1) {
			// TODO Auto-generated catch block
			e1.printStackTrace();
		}
		try {
			preparedStmt5.setInt(1, bid);
		} catch (SQLException e1) {
			// TODO Auto-generated catch block
			e1.printStackTrace();
		}

	}

	private static void checkout(int cardId) {

		int bid = -1;
		int waiting = -1;

		System.out.println("\nEnter a book id you want to check out: ");
		Scanner in = new Scanner(System.in);

		bid = in.nextInt();

		String query_CO = "SELECT Count(*) as waiting FROM BookWaitList where bid LIKE ? ";
		PreparedStatement query_CO_statment = null;
		try {
			query_CO_statment = con.prepareStatement(query_CO);
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}

		try {
			query_CO_statment.setInt(1, bid);
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
		ResultSet rs2 = null;
		try {
			rs2 = query_CO_statment.executeQuery();
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}

		try {
			while (rs2.next()) {

				waiting = rs2.getInt("waiting");
				// cardId = rs2.getInt("cardId");
				System.out
						.println("\nThe number of people reserving this book is: ");
				System.out.print(waiting);

			}
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}

		if (waiting > 0) {
			int oldestCardId = -1;

			query_CO = "SELECT bid, cardId, MIN(dateAdded) FROM BookWaitList where bid LIKE ?";
			query_CO_statment = null;
			try {
				query_CO_statment = con.prepareStatement(query_CO);
			} catch (SQLException e) {
				// TODO Auto-generated catch block
				e.printStackTrace();
			}

			try {
				query_CO_statment.setInt(1, bid);
			} catch (SQLException e) {
				// TODO Auto-generated catch block
				e.printStackTrace();
			}
			rs2 = null;
			try {
				rs2 = query_CO_statment.executeQuery();
			} catch (SQLException e) {
				// TODO Auto-generated catch block
				e.printStackTrace();
			}

			try {
				while (rs2.next()) {

					oldestCardId = rs2.getInt("cardId");
					// cardId = rs2.getInt("cardId");
					System.out
							.println("\nThe card Id with the oldest reservation is: ");
					System.out.print(oldestCardId);

					if (oldestCardId == cardId) {
						System.out
								.println("\nCongrats you hold the oldest reservation the book is due in 30 days: ");

						System.out
								.println("\nCongrats he book is due in 30 days: ");

						String query_3 = "INSERT INTO `CheckoutRecord` (`bid`, `cardId`)"
								+ " values (?, ? )";
						// create the mysql insert preparedstatement
						PreparedStatement preparedStmt = null;
						try {
							preparedStmt = con.prepareStatement(query_3);
						} catch (SQLException e1) {
							// TODO Auto-generated catch block
							e1.printStackTrace();
						}
						try {
							preparedStmt.setInt(1, bid);
						} catch (SQLException e1) {
							// TODO Auto-generated catch block
							e1.printStackTrace();
						}
						try {
							preparedStmt.setInt(2, cardId);
						} catch (SQLException e1) {
							// TODO Auto-generated catch block
							e1.printStackTrace();
						}

						try {
							// execute the preparedstatement
							preparedStmt.execute();

						} catch (SQLException e) {

							e.printStackTrace();
						}

						String updateTableSql = "Update Book set available = 0 where bid LIKE ? ;";

						// create the mysql insert preparedstatement
						PreparedStatement preparedStatement;
						try {
							preparedStatement = con
									.prepareStatement(updateTableSql);

							preparedStatement.setInt(1, bid);

							preparedStatement.executeUpdate();

						} catch (SQLException e) {
							// TODO Auto-generated catch block
							e.printStackTrace();
						}

					} else {
						System.out
								.println("\nYou may not check this book out at this time. ");
						break;
					}

				}
			} catch (SQLException e) {
				// TODO Auto-generated catch block
				e.printStackTrace();
			}

		} else {
			System.out.println("\nCongrats he book is due in 30 days: ");

			String query_3 = "INSERT INTO `CheckoutRecord` (`bid`, `cardId`)"
					+ " values (?, ? )";
			// create the mysql insert preparedstatement
			PreparedStatement preparedStmt = null;
			try {
				preparedStmt = con.prepareStatement(query_3);
			} catch (SQLException e1) {
				// TODO Auto-generated catch block
				e1.printStackTrace();
			}
			try {
				preparedStmt.setInt(1, bid);
			} catch (SQLException e1) {
				// TODO Auto-generated catch block
				e1.printStackTrace();
			}
			try {
				preparedStmt.setInt(2, cardId);
			} catch (SQLException e1) {
				// TODO Auto-generated catch block
				e1.printStackTrace();
			}

			try {
				// execute the preparedstatement
				preparedStmt.execute();

			} catch (SQLException e) {

				e.printStackTrace();
			}

			String updateTableSql = "Update Book set available = '0' where bid LIKE ? ;";

			// create the mysql insert preparedstatement
			PreparedStatement preparedStatement;
			try {
				preparedStatement = con.prepareStatement(updateTableSql);

				preparedStatement.setInt(1, bid);

				preparedStatement.executeUpdate();

			} catch (SQLException e) {
				// TODO Auto-generated catch block
				e.printStackTrace();
			}
		}

	}

	private static void register() {

		String uname = null;
		String fullName = null;

		String address = null;
		String phone = null;
		String email = null;
		int isregistered = 11;

		System.out.println("\nEnter a new username: ");
		Scanner in = new Scanner(System.in);

		uname = in.nextLine();

		String query_2 = "SELECT count(*)as users FROM cs5530db38.User where userName LIKE ?";
		PreparedStatement query_2_statment = null;
		try {
			query_2_statment = con.prepareStatement(query_2);
		} catch (SQLException e) {

			e.printStackTrace();
		}

		try {
			query_2_statment.setString(1, "%" + uname + "%");
		} catch (SQLException e) {

			e.printStackTrace();
		}
		ResultSet rs2 = null;
		try {
			rs2 = query_2_statment.executeQuery();

		} catch (SQLException e) {

			e.printStackTrace();
		}
		// System.out.println("Results for query 2");
		try {
			while (rs2.next()) {
				// System.out.print("The number of users with that username: ");

				isregistered = rs2.getInt("users");

				if (isregistered == 1) {

					System.out.print("\nThat username is taken try again: ");
					register();

				}

				if (isregistered == 0) {

					// System.out.print(isregistered);

					System.out.print("\nThat username is available: ");
					System.out.print("\nEnter your Name: ");
					Scanner namescan = new Scanner(System.in);

					fullName = namescan.nextLine();
					System.out.print("\nHello: " + fullName);

					System.out.print("\nEnter your address: ");
					address = namescan.nextLine();
					System.out.print("your address: " + address);

					System.out.print("\nEnter your phone number: ");
					phone = namescan.nextLine();
					System.out.print("your phone: " + phone);

					System.out.print("\nEnter your email address: ");
					email = namescan.nextLine();
					System.out.print("your email: " + email);

					String query_3 = "INSERT INTO `cs5530db38`.`User` (`userName`, `fullName`, `address`, `phone`, `email`)"
							+ " values (?, ?, ?, ?, ?)";
					// create the mysql insert preparedstatement
					PreparedStatement preparedStmt = con
							.prepareStatement(query_3);
					preparedStmt.setString(1, uname);
					preparedStmt.setString(2, fullName);
					preparedStmt.setString(3, address);
					preparedStmt.setString(4, phone);
					preparedStmt.setString(5, email);

					try {
						// execute the preparedstatement
						preparedStmt.execute();

					} catch (SQLException e) {

						e.printStackTrace();
					}

					String query_4 = "SELECT * FROM User where userName LIKE ?";
					PreparedStatement query_4_statment = null;
					try {
						query_4_statment = con.prepareStatement(query_4);
					} catch (SQLException e) {
						// TODO Auto-generated catch block
						e.printStackTrace();
					}

					try {
						query_4_statment.setString(1, "%" + uname + "%");
					} catch (SQLException e) {
						// TODO Auto-generated catch block
						e.printStackTrace();
					}
					ResultSet rs4 = null;
					try {
						rs4 = query_4_statment.executeQuery();
					} catch (SQLException e) {
						// TODO Auto-generated catch block
						e.printStackTrace();
					}
					System.out.println("\nCongrats " + fullName);
					try {
						while (rs4.next()) {
							System.out.print(" your user name is: ");
							System.out.print(rs4.getString("userName"));
							System.out.print(" and your card number is ");
							System.out.print(rs4.getString("cardId"));
							System.out.print(". \nYou may now login \n ");
						}
					} catch (SQLException e) {
						// TODO Auto-generated catch block
						e.printStackTrace();
					}
					System.out.println("");

					break;

				}

			}
		} catch (SQLException e) {

			e.printStackTrace();
		}
		System.out.println("");

		// System.out.println("You Entered 1");

	}

}